<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\Org;
use App\Technology;
use App\Industry;
use App\Domain;
use App\Tag;
use App\User;

class PagesController extends Controller
{
    /**
     * Number of results per page
     */
    protected $paginate = 12;

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
        $orgs = $category->orgs()->paginate($this->paginate);
        
        return view('pages.category', compact('category', 'type', 'orgs'));
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
        $orgs = $category->orgs()->paginate($this->paginate);
        
        return view('pages.category', compact('category', 'type', 'orgs'));
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

        $orgs = Org::whereIn('id', $org_ids)->paginate($this->paginate);
        
        return view('pages.category', compact('category', 'type', 'orgs'));
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
        $orgs = $category->orgs()->paginate($this->paginate);
        
        return view('pages.category', compact('category', 'type', 'orgs'));
    }
    
    /**
     * Display orgs associated with a given user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userOrgs($id)
    {
        if(Auth::user()->id != $id) abort(403);

        $user = User::findOrFail($id);
        $orgs = $user->orgs()->paginate($this->paginate);
        
        return view('pages.user-orgs', compact('orgs'));
    }

    /**
     * Display discussions associated with a given user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userDiscussions($id)
    {
        if(Auth::user()->id != $id) abort(403);

        $user = User::findOrFail($id);
        $discussions = $user->discussions()->paginate($this->paginate);
        
        return view('pages.user-discussions', compact('discussions'));
    }
}
