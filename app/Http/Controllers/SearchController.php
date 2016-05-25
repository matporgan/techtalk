<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Org;

class SearchController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->search;
        $terms = explode(" ", $query);
        
        $multipliers = [
            'name'          => 5, 
            'short_desc'    => 1, 
            'long_desc'     => 2,
            'technology'    => 4,
            'industry'      => 4,
            'domain'        => 4,
            'tag'           => 4,
        ];
        
        $limit = 50;
        
        if (trim($terms[0]) == "")
        {
            $orgs = Org::paginate(12);
        }
        else 
        {
            $orgs = Org::all();
            
            // set ranking to 0
            foreach($orgs as $org) {
                $org->rank = 0;
            }
            
            // get results
            foreach($orgs as $org) {
                foreach($terms as $term) {
                    // search org name
                    similar_text($org->name, $term, $percent);
                    if ($percent < $limit) $percent = 0;
                    $org->rank += $multipliers['name'] * sqrt($percent / 100);
                    //dd($org->rank);
                    
                    similar_text($org->short_desc, $term, $percent);
                    if ($percent < $limit) $percent = 0;
                    $org->rank += $multipliers['short_desc'] * sqrt($percent / 100);
                    // dd($percent);
                    // dd($org->rank);
                    
                    similar_text($org->long_desc, $term, $percent);
                    if ($percent < $limit) $percent = 0;
                    $org->rank += $multipliers['long_desc'] * sqrt($percent / 100);
                    //dd($org->rank);
                    
                    foreach($org->technologies as $technology) {
                        similar_text($technology->name, $term, $percent);
                        if ($percent < $limit) $percent = 0;
                        $org->rank += $multipliers['technology'] * sqrt($percent / 100);
                    }
                    
                    foreach($org->industries as $industry) {
                        similar_text($industry->name, $term, $percent);
                        if ($percent < $limit) $percent = 0;
                        $org->rank += $multipliers['industry'] * sqrt($percent / 100);
                    }
                    
                    foreach($org->domains as $domain) {
                        similar_text($domain->name, $term, $percent);
                        if ($percent < $limit) $percent = 0;
                        $org->rank += $multipliers['domain'] * sqrt($percent / 100);
                    }
                    
                    foreach($org->tags as $tag) {
                        similar_text($tag->name, $term, $percent);
                        if ($percent < $limit) $percent = 0;
                        $org->rank += $multipliers['tag'] * sqrt($percent / 100);
                    }
                }
            }
            
            // foreach ($orgs as $org) {
            //     $rank[] = $org->id . ': ' . $org->rank;
            // }
            
            // dd($rank);
            
            $orgs = $orgs->sortByDesc('rank')->reject(function($org, $key) {
                return $org->rank == 0;
            });
            
            $ids = null;
            foreach ($orgs as $org) {
                $ids[] = $org->id;
            }
            
            $orgs = Org::whereIn('id', $ids)->paginate(12);
        }
        
        // display results
        return view('pages.orgs', compact('orgs', 'query'));
    }
}
