<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\OrgRequest;

use App\Org;
use App\Technology;
use App\Industry;
use App\Domain;
use App\Cycle;
use App\Phase;
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

        return view('orgs.index', compact('orgs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();

        //dd($categories['domains'][0]['attributes']['industry_id']);
        return view('orgs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrgRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrgRequest $request)
    {
        //dd($request);
        $org = Org::create($request->all());

        $this->syncCategories($request, $org);

        // flash()->success('Success!', 'Your organisation has been created.');

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
        
        return view('orgs.show', compact('org'));
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

        $categories = $this->getCategories();
        
        return view('orgs.edit', compact('org', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrgRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrgRequest $request, $id)
    {
        $org = Org::findOrFail($id);

        $org->update($request->all());

        $this->syncCategories($request, $org);

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

        $org->destroy();

        return redirect("/orgs/{$org->id}");
    }

    /**
     * 
     */
    public function addDocument(Request $request, $id) 
    {
        $org = Org::findOrFail($id);

        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $file->move('orgs/documents', $name);



        return 'done';
    }

    /**
     * Sync up the lists of categories in the database.
     * 
     * @param  OrgRequest  $request
     * @param  Org  $org
     */
    private function syncCategories(OrgRequest $request, Org $org)
    {
        // sync categories
        $org->technologies()->sync($request->input('technology_list'));
        $org->industries()->sync($request->input('industry_list'));
        $org->domains()->sync($request->input('domain_list'));

        // check to see if tag list is empty
        $tag_list = $request->input('tag_list');       
        if(!empty($tag_list)) {
            // check for new tags
            $tag_list = $this->checkForNewTags($tag_list);
        }
        else {
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
     * @return  OrgRequest  array
     */
    private function getCategories()
    {   
        // get number of industries
        $industries = Industry::lists('name', 'id')->all();
        $industriesCount = count($industries);

        // create array for each of the industry domains
        for ($i=1; $i<=$industriesCount; $i++)
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
    
}
