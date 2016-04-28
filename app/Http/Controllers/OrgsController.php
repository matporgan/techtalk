<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\OrgRequest;

use App\Org;
use App\Technology;
use App\Industry;
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

        return view('orgs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrgRequest $request)
    {
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
     * @param  \Illuminate\Http\Request  $request
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
        $org->cycles()->sync($request->input('cycle_list'));
        $org->phases()->sync($request->input('phase_list'));

        // check for new tags from user before syncing
        $syncTagList = $this->checkForNewTags($request->input('tag_list'));
        $org->tags()->sync($syncTagList);
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
        return [
            'technologies' => Technology::lists('name', 'id')->all(),
            'industries' => Industry::lists('name', 'id')->all(),
            'cycles' => Cycle::lists('name', 'id')->all(),
            'phases' => Phase::lists('name', 'id')->all(),
            'tags' => Tag::lists('name', 'id')->all()
        ];
    }
    
}
