<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
    public function addLink(Request $request, $id) 
    {
        $org = Org::findOrFail($id);

        // create DB entry
        $org->links()->create([
            'url' => $request->url,
            'description' => $request->description
        ]);
        
        return redirect("/orgs/{$org->id}");
    }
}
