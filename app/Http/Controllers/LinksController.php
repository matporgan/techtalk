<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Traits\AuthorizesUsers;

use App\Link;
use App\Org;

class LinksController extends Controller
{
    use AuthorizesUsers; 

    /**
     * Add link to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) 
    {
        if(! $this->isUserLegit($id)) 
        {
            return $this->unauthorized();
        }
        
        $org = Org::findOrFail($id);

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
    public function destroy($org_id, $link_id) {
        if(! $this->isUserLegit($org_id)) 
        {
            return $this->unauthorized();
        }
        
    	Link::destroy($link_id);
    	return back();
    }
}
