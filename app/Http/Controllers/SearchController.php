<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Search;
use URL;

use App\Org;
use App\Discussion;
use App\Technology;
use App\Industry;
use App\Domain;
use App\Tag;

class SearchController extends Controller
{
    // /**
    //  * Implements laravel-lucene-search to find query results
    //  * 
    //  * @param  Request $request
    //  * @return \Illuminate\Http\Response
    //  */aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    // public function search(Request $request)
    // {
    //     $url = URL::previous();
    //     $origin = substr($url, strrpos($url, '/') + 1);

    //     if($origin == 'discuss') {
    //         return $this->searchDiscussions($request);
    //     }
    //     else{
    //         return $this->searchOrgs($request);
    //     }
    // }

    /**
     * Implements laravel-lucene-search to find org query results
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function orgs(Request $request)
    {
        // laravel-lucene-search bug fixes
        $fixed_query = $this->luceneBugPatch($request);

        // if query is empty, return all orgs (using lucene_search table column)
        if (trim($fixed_query) == "")
        {
            $fixed_query = 'jerome';
        }
        
        // get search results and filter
        $result = Search::query($fixed_query, '*', ['phrase' => false, 'fuzzy' => 0.5]);
        $result = $this->filterOrgs($request, $result);
        
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
        $query = $request->search; // original query
        $categories = $this->getCategories();
        return view('pages.orgs', compact('orgs', 'query', 'categories'));
    }

    /**
     * Implements laravel-lucene-search to find discussion query results
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function discussions(Request $request)
    {
        // laravel-lucene-search bug fixes
        $fixed_query = $this->luceneBugPatch($request);

        // if query is empty, return all discussions
        if (trim($fixed_query) == "")
        {
            // sort discussions by last update
            $discussions = Discussion::with('comments')
                ->where('updated', '!=', 'NULL')
                ->orderBy('updated', 'desc')
                ->paginate(10);
        }
        else
        {
            // get search results and filter
            $search = Search::query($fixed_query, '*', ['phrase' => false, 'fuzzy' => 0.5]);
            
            $results = $search->get(); 
            $ids = null;
            foreach ($results as $result) 
            {
                if (class_basename($result) === 'Discussion')
                {
                    $ids[] = $result->id;
                }
                elseif (class_basename($result) === 'Comment')
                {
                    $ids[] = $result->discussion->id;
                }
            }

            // sort discussions by last update
            $discussions = Discussion::with('comments')
                ->where('updated', '!=', 'NULL')
                ->whereIn('id', $ids)
                ->orderBy('updated', 'desc')
                ->paginate(10);
        }

        // display results
        $query = $request->search; // original query
        $categories = $this->getCategories();
        return view('pages.discussions', compact('discussions', 'query', 'categories'));
    }

    /**
     * Simple lucene-search bug patching.
     * 
     * @param  Result $result
     * @param  Request $request
     * @return Result $result
     */
    private function luceneBugPatch(Request $request) {
        $fixed_query = str_replace('and', '', $request->search);
        $fixed_query = str_replace('or', '', $fixed_query);
        $fixed_query = str_replace('xor', '', $fixed_query);
        $fixed_query = str_replace('not', '', $fixed_query);

        return $fixed_query;
    }
    
    /**
     * Filter the search results based on the request values.
     * 
     * @param  Result $result
     * @param  Request $request
     * @return Result $result
     */
    private function filterOrgs(Request $request, $result)
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
