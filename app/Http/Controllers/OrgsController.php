<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrgRequest;
use App\Http\Requests\OrgUpdateRequest;

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
        $orgs = Org::all();

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
    public function store(OrgRequest $request)
    {
        // explode tags from string
        //$request->merge(array('tag_list' => explode(",", $request->tag_list[0])));

        // create database entry
        $org = Org::create($request->all()); // org model
        $org->users()->attach(Auth::user()->id); // add user
        $this->syncCategories($request, $org); // add categories
        
        // move logo to storage
        $this->moveLogo($request, $org);

        // flash and redirect
        $request->session()->flash('success', 'Your organisation has been created.');
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
        $org = Org::findOrFail($id);
        
        return view('pages.org', compact('org'));
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

        return view('orgs.edit', compact('org', 'categories', 'selections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrgRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrgUpdateRequest $request, $id)
    {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) abort(403);

        // explode tags from string
        //$request->merge(array('tag_list' => explode(",", $request->tag_list[0])));
        
        // update database entry
        $org->update($request->all());
        $this->syncCategories($request, $org);

        if($request->file('logo') != null)
            $this->moveLogo($request, $org);
        
        return redirect("/orgs/{$org->id}");
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
     * Add a contributor for the given org.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adduser(Request $request, $id)
    {
        //dd($request);
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) abort(403);

        $user = User::where('email', $request->email)->first();
        if ($user !== null)
        {
            $org->users()->attach($user->id);
        }
        else
        {
            $request->session()->flash('failure', 'That email does not match any users in our records.');
        }

        return redirect("/orgs/{$org->id}");
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

        // check to see if tag list is empty
        $tag_list = $request->input('tag_list');       
        if(! empty($tag_list)) 
        {
            // check for new tags
            $tag_list = $this->checkForNewTags($tag_list);
        }
        else 
        {
            // change null to empty array
            $tag_list = [];
        }
        $org->tags()->sync($tag_list);
    }

    /**
     * Check to see if the user has entered new tags
     *
     * @param  array  $tags_id
     * @return  array
     */
    private function checkForNewTags(array $tags_id)
    {
        $allDBTags = Tag::lists("id")->toArray(); // get all the tags in the db

        $newTagsList = array_diff($tags_id, $allDBTags);
        $syncTagsList = array_diff($tags_id, $newTagsList);

        foreach ($newTagsList as $newTag)
        {
            // create a new tag
            $newTagModel = Tag::create(["name" => $newTag]);
            $syncTagsList[] = $newTagModel->id;
        }
        return $syncTagsList;
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
            'tags' => Tag::orderBy('count')->lists('name', 'id')->all()
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
    
    
        
}
