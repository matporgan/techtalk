<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;
use Session;

use App\Link;
use App\Org;

class LinksController extends Controller
{
    /**
     * Add link to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) 
    {
        $org = Org::findOrFail($id);

        // authorization
        if (Gate::denies('update-org', $org)) { abort(403); }

        $url = addHttp($request->url);

        // create DB entry
        $org->links()->create([
            'url' => $url,
            'description' => $request->description
        ]);
        
        Session::flash('success', 'Link successfully added!');
        return back();
    }

    /**
     * Update the specified link.
     *
     * @param  Request $request
     * @param  int  $id
     * @param  int  $link_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $link_id)
    {
        // authorization
        $org = Org::findOrFail($id);
        if (Gate::denies('update-org', $org)) abort(403);

        // update database entry
        $link = Link::findOrFail($link_id);
        $link->update($request->all());

        // flash and redirect
        Session::flash('success', 'Successfully updated!');
        return redirect("/orgs/{$org->id}");
    }

    /**
     * Destroy the link.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $link_id) {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) { abort(403); }
        
    	Link::destroy($link_id);
        
    	return back();
    }
}
