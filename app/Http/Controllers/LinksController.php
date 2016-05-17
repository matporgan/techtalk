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

        $url = $this->addHttp($request->url);

        // create DB entry
        $org->links()->create([
            'url' => $url,
            'description' => $request->description
        ]);
        
        Session::flash('success', 'Link successfully added!');
        return back();
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

    /**
     * Add http if not already present.
     *
     * @param  string $url
     * @return string
     */
    private function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
}
