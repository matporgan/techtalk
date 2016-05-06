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
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);
        
        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.technology', compact('technology','org_list'));
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
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);
        
        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.industry', compact('industry','org_list'));
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
        
        // get domains with same alias
        $domains = Domain::where('alias', $domain->alias)->get();

        foreach($domains as $domain)
        {
            foreach($domain->orgs as $org)
            {
                $org_ids[] = $org->pivot->org_id;
            }  
        }
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);

        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.domain', compact('domain','org_list'));
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
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);

        $org_list = Org::whereIn('id', $org_ids)->get();
        
        return view('pages.tag', compact('tag','org_list'));
    }
}
