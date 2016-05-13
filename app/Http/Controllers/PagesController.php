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
        $category = Technology::findOrFail($id);
        $type = 'Technology';
        
        foreach($category->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);
        
        $orgs = Org::whereIn('id', $org_ids)->get();
        
        return view('orgs.category', compact('category', 'type', 'orgs'));
    }
    
    

    /**
     * Display the specified industry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function industry($id)
    {
        $category = Industry::findOrFail($id);
        $type = 'Industry';
        
        foreach($category->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);
        
        $orgs = Org::whereIn('id', $org_ids)->get();
        
        return view('orgs.category', compact('category', 'type', 'orgs'));
    }
    
    /**
     * Display the specified domain.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function domain($id)
    {
        $category = Domain::findOrFail($id);
        $type = 'Domain';
        
        // get domains with same alias
        $domains = Domain::where('alias', $category->alias)->get();

        foreach($domains as $domain)
        {
            foreach($domain->orgs as $org)
            {
                $org_ids[] = $org->pivot->org_id;
            }  
        }
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);

        $orgs = Org::whereIn('id', $org_ids)->get();
        
        return view('orgs.category', compact('category', 'type', 'orgs'));
    }
    
    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tag($id)
    {
        $category = Tag::findOrFail($id);
        $type = 'Tag';
        
        foreach($category->orgs as $org)
        {
            $org_ids[] = $org->pivot->org_id;
        }
        // return 404 if no ids found
        if (empty($org_ids)) return abort(404);

        $orgs = Org::whereIn('id', $org_ids)->get();
        
        return view('orgs.category', compact('category', 'type', 'orgs'));
    }
}
