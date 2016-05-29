<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Search;

use App\Org;
use App\Technology;
use App\Industry;
use App\Domain;
use App\Tag;

class SearchController extends Controller
{
    /**
     * 
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->search;
        
        // laravel-lucene-search bug fixes
        $fixed_query = str_replace('and', '', $query);
        $fixed_query = str_replace('or', '', $fixed_query);
        $fixed_query = str_replace('xor', '', $fixed_query);
        $fixed_query = str_replace('not', '', $fixed_query);
        
        // if query is empty, return all orgs (using lucene_search table column)
        if (trim($fixed_query) == "")
        {
            $fixed_query = 'jerome';
        }
        
        // get search results and filter
        $result = Search::query($fixed_query, '*', ['phrase' => false, 'fuzzy' => 0.5]);
        $result = $this->filterResults($request, $result);
        
        // get orgs and their ids
        $orgs = $result->get();
        $ids = null;
        foreach ($orgs as $org) 
        {
            $ids[] = $org->id;
        }
        
        // re-get orgs and paginate
        $orgs = Org::whereIn('id', $ids)->paginate(12);
        
        // display results
        $categories = $this->getCategories();
        return view('pages.orgs', compact('orgs', 'query', 'categories'));
    }
    
    /**
     * Filter the search results based on the request values.
     * 
     * @param  Result $result
     * @param  Request $request
     * @return Result $result
     */
    private function filterResults(Request $request, $result)
    {
        $technology_names = $request->technology_list;
        $industry_names = $request->industry_list;
        $domain_names = $request->domain_list;
        $partner_status = $request->partner_status;
        $in_talks = $request->in_talks;
        
        // filter by technology
        if (! empty($technology_names))
        {
            foreach($technology_names as $technology_name)
            {
                $result = $result->where('technologies', $technology_name);
            }
        }
        
        // filter by industry
        if (! empty($industry_names))
        {
            foreach($industry_names as $industry_name)
            {
                $result = $result->where('industries', $industry_name);
            }
        }
        
        // filter by domain
        if (! empty($domain_names))
        {
            foreach($domain_names as $domain_name) 
            {
                $result = $result->where('domains', $domain_name);
            }
        }
        
        // filter by partner status
        if ($partner_status != '')
        {
            $result = $result->where('partner_status', $partner_status);
        }
        
        // filter by in talks status
        if ($in_talks != '')
        {
            $result = $result->where('in_talks', $in_talks);
        }
        
        return $result;
    }
    
    /**
     * Get a 2D array of all the categories in the database.
     * 
     * @return array
     */
    private function getCategories()
    {   
        // create array for each of the industry domains
        $industries = Industry::lists('name', 'id')->all();

        for ($i=1; $i<=count($industries); $i++)
        {
            $domains[$i] = Domain::where('industry_id', $i)->lists('name', 'id')->all();
        }

        return [
            'technologies' => Technology::lists('name', 'id')->all(),
            'industries' => $industries,
            'domains' => $domains,
            'tags' => Tag::lists('name', 'id')->all()
        ];
    }
}
