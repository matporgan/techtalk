<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;

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

        // create DB entry
        $org->links()->create([
            'url' => $request->url,
            'description' => $request->description
        ]);
        
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
