<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Org;
use App\Technology;
use App\Industry;
use App\Domain;
use App\Tag;

class PagesController extends Controller
{
    /**
     * Display the specified technology.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function technology($id)
    {
        $technology = Technology::findOrFail($id);
        
        foreach($technology->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }
        
        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.category', compact('technology','org_list'));
    }

    /**
     * Display the specified industry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function industry($id)
    {
        $industry = Industry::findOrFail($id);
        
        foreach($industry->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }
        
        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.category', compact('org_list'));
    }
    
    /**
     * Display the specified domain.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function domain($id)
    {
        $domain = Domain::findOrFail($id);
        
        foreach($domain->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }
        
        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.category', compact('org_list'));
    }
    
    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tag($id)
    {
        $tag = Tag::findOrFail($id);
        
        foreach($tag->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }

        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.category', compact('org_list'));
    }
}
