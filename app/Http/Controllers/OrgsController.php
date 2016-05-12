<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Gate;

use App\Org;
use App\User;
use App\Technology;
use App\Industry;
use App\Domain;
use App\Tag;

class OrgsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgs = Org::orderBy('id', 'desc')->get();

        return view('pages.orgs', compact('orgs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();

        // redirect if not logged in
        if (! Auth::check()) return redirect('register');

        return view('pages.org-create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrgRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make tag string lowercase and explode. conversion: "tag 1, TAG 2, Tag 3" => ["tag1", "tag 2", "tag 3"]
        $request->merge(array('tag_list' => explode(",", strtolower($request->tag_list))));
        
        // create database entry
        $org = Org::create($request->all()); // org model
        $org->users()->attach(Auth::user()->id, ['org_role' => 'owner']); // add user
        $this->syncCategories($request, $org); // add categories
        
        // move logo to storage
        $this->moveLogo($request, $org);

        // flash and redirect
        $request->session()->flash('success', 'Organisation successfully created!');
        return redirect("/orgs/{$org->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $org = Org::with('comments')->findOrFail($id);
        $users = User::lists('email')->all();
        $comments = $this->getOrderedComments($org);

        return view('pages.org', compact('org', 'users', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) abort(403);
        
        $categories = $this->getCategories();
        $selections = $this->getSelections($org);

        return view('pages.org-edit', compact('org', 'categories', 'selections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrgRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) abort(403);

        // make tag string lowercase and explode. conversion: "tag 1, TAG 2, Tag 3" => ["tag1", "tag 2", "tag 3"]
        $request->merge(array('tag_list' => explode(",", strtolower($request->tag_list))));
        
        // update database entry
        $org->update($request->all());
        $this->syncCategories($request, $org);

        if($request->file('logo') != null)
            $this->moveLogo($request, $org);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) abort(403);

        $org->delete();
        return redirect("/orgs");
    }

    /**
     * Move logo to storage location and add to database.
     *
     * @param  OrgRequest  $request
     * @param  Org  $org
     */
    public function moveLogo(Request $request, Org $org) 
    {
        $storage = 'storage/logos/';

        // create filenames
        $file = $request->file('logo');
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $name = 'logo_' . $org->id . '.' . $ext;
        
        // move file
        $file->move($storage, $name);

        // update DB entry
        $org->logo = '/' . $storage . $name;
        $org->save();
    }

    /**
     * Sync up the lists of categories in the database.
     * 
     * @param  OrgRequest  $request
     * @param  Org  $org
     */
    private function syncCategories(Request $request, Org $org)
    {
        // sync categories
        $org->technologies()->sync($request->input('technology_list'));
        $org->industries()->sync($request->input('industry_list'));
        $org->domains()->sync($request->input('domain_list'));

        // check for new tags (or change to empty array if tags empty)
        $tag_list = ($request->tag_list == "" ? [] : $this->checkForNewTags($request->tag_list));

        $org->tags()->sync($tag_list);
    }

    /**
     * Check to see if the user has entered new tags
     *
     * @param  array  $tags_id
     * @return  array
     */
    private function checkForNewTags($tag_list)
    {
        $all_tags = Tag::lists("name")->toArray(); // get all the tags in the db
        
        // determine which tags are new
        $new_tags = array_diff($tag_list, $all_tags);
        // determine which tags are already in the DB
        $old_tags = array_diff($tag_list, $new_tags);

        foreach ($old_tags as $old_tag)
        {
            // get id of existing tags
            $sync_tags[] = Tag::where('name', $old_tag)->first()->id;
        }

        foreach ($new_tags as $new_tag)
        {
            // create new tags
            $new_tag_model = Tag::create(["name" => $new_tag]);
            $sync_tags[] = $new_tag_model->id;
        }

        return $sync_tags;
    }

    /**
     * Get a 2D array of all the categories in the database.
     * 
     * @return array
     */
    private function getCategories()
    {   
        // create array for each of the industry domains
        $industries = Industry::lists('name', 'id')->all();

        for ($i=1; $i<=count($industries); $i++)
        {
            $domains[$i] = Domain::all()->where('industry_id', $i)->lists('name', 'id');
        }

        return [
            'technologies' => Technology::lists('name', 'id')->all(),
            'industries' => $industries,
            'domains' => $domains,
            'tags' => Tag::lists('name', 'id')->all()
        ];
    }
    
    /**
     * Get a 2D array of all the selections of each of the categories.
     * 
     * @param  Org $org
     * @return array
     */
    private function getSelections(Org $org)
    {   
        return [
            'technologies' => $org->technologies->lists('id')->all(),
            'industries' => $org->industries->lists('id')->all(),
            'domains' => $org->domains->lists('id')->all(),
            'tags' => implode(',', $org->tags->lists('name')->all())
        ];
    }
    
    /**
     * Gets an array of comment collections in the correct display order.
     *
     * @param  Org $org
     * @return array $comments
     */
    public function getOrderedComments(Org $org)
    {  
        $comment_parent_ids = $org->comments->lists('parent_id', 'id')->all();

        // check to ensure comments exist
        if(empty($comment_parent_ids))
            return null;
        
        // get id and parent_id arrays and order them
        $comment_ids = array_keys($comment_parent_ids);
        $parent_ids = array_values($comment_parent_ids);
        $ordered_ids = $this->getOrderedParentChildList($comment_ids, $parent_ids);
        
        // get collections based off $ordered_ids
        static $comment;
        for($i=0; $i<count($org->comments); $i++)
        {
            if($i > 0)
            { 
                $previous = $comment; 
                $comment = $org->comments->where('id', $ordered_ids[$i][0])->first();
                $comment->setLevel($ordered_ids[$i][1]);
                $comment->setParentName($previous->user->name);
            }
            else
            {
                $comment = $org->comments->where('id', $ordered_ids[$i][0])->first();
                $comment->setLevel($ordered_ids[$i][1]);
            }
            $comments[] = $comment;
        }
        
        return $comments;
    }

    /**
     * Orders an array of ids based on an array of parent ids. 
     * Also adds a 'level' attribute to each id for css indenting.
     * E.g. [ID]   [PID]     [ID,Level]
     *      [ 1]   [  -]     [  1,0   ]
     *      [ 2]   [  -]     [  3,1   ]
     *      [ 3]   [  1]     [  5,2   ]
     *      [ 4] & [  1]  => [  4,1   ]
     *      [ 5]   [  3]     [  8,2   ]
     *      [ 6]   [  1]     [  9,2   ]
     *      [ 7]   [  2]     [  6,1   ]
     *      [ 8]   [  4]     [  2,0   ]
     *      [ 9]   [  4]     [  7,1   ]
     * 
     * @param  array $ids
     * @param  array $parent_ids
     * @param  array $ordered_ids = null
     * @param  int $position = 0
     * @return array $ordered_ids
     */
    public function getOrderedParentChildList($ids, $parent_ids, $ordered_ids = array(null), $position = 0)
    {
        static $level = 0; // indent level of id

        if(! empty($ids)) // if ids remain
        {
            // place $id at $position into ordered array
            $id = $ids[$position];
            $ordered_ids[] = [$id, $level];
            
            // remove ids from lists
            unset($ids[$position]);
            $ids = array_values($ids);
            unset($parent_ids[$position]);
            $parent_ids = array_values($parent_ids);

            // check if id has children
            $children = array_keys($parent_ids, $id);

            if(! empty($children)) // children found
            {
                // increase indent level
                $level++; 

                // get ids of children
                foreach($children as $child)
                {
                    $child_ids[] = $ids[$child];
                }

                foreach($child_ids as $child_id)
                {
                    // get next child's position
                    $next_pos = array_search($child_id, $ids);

                    // call getOrderedParentChildList on that child
                    $results = $this->getOrderedParentChildList($ids, $parent_ids, $ordered_ids, $next_pos); // 6
                    
                    // put results back into arrays
                    $ids = $results[0];
                    $parent_ids = $results[1];
                    $ordered_ids = $results[2];
                }

                // no more children; reduce indent
                $level--;
            }

            if($level != 0) 
            {
                // pass arrays back to parent
                return [$ids, $parent_ids, $ordered_ids];
            }
            else 
            {
                // move on to next root id
                return $this->getOrderedParentChildList($ids, $parent_ids, $ordered_ids);
            }
        }
        else // no more ids
        {
            array_shift($ordered_ids); // remove first null element
            return $ordered_ids;
        }
    }    
        
}
