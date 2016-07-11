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
use App\Discussion;
use App\Comment;

class PagesController extends Controller
{
    /**
     * Number of results per page
     */
    protected $paginate = 12;

    // /**
    //  * Home page controller
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function home()
    // {
    //     $orgs = Org::all();
    //     $users = User::all();
    //     $discussions = Discussion::all();
    //     $comments = Comment::all();

    //     $categories = [
    //         'technologies' => [
    //             'emerging' => Technology::where('subcategory', 'Emerging')->get(),
    //             'stable' => Technology::where('subcategory', 'Stable')->get(),
    //             'accelerating' => Technology::where('subcategory', 'Accelerating')->get(),
    //         ],
    //         'industries' => Industry::all(),
    //         'domains' => Domain::all()->groupBy('industry_id')->chunk(3),
    //     ];

    //     $latest_orgs = $orgs->sortByDesc('id')->take(4);

    //     $top_contributors = $users->sortBy(function ($user, $key) {
    //         $org_count = $user->orgs()->count();
    //         $user['org_count'] = $org_count;
    //         return -$org_count; // reversed
    //     })->take(5);

    //     $top_commentors = $users->sortBy(function ($user, $key) {
    //         $comment_count = $user->comments()->count();
    //         $user['comment_count'] = $comment_count;
    //         return -$comment_count; // reversed
    //     })->take(5);

    //     $stats = [
    //         'Organisations' => $orgs->count(),
    //         'Discussions' => $discussions->count(),
    //         'Comments' => $comments->count(),
    //         'Users' => $users->count(),
    //     ];

    //     return view('pages.home1', compact('orgs', 'discussions', 'latest_orgs', 'top_contributors', 'top_commentors', 'stats', 'categories'));
    // }

    /**
     * Home page controller
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $orgs = Org::all();
        $users = User::all();
        $discussions = Discussion::all();
        $comments = Comment::all();

        $technologies = Technology::all();
        $industries = Industry::all();
        $tags = Tag::has('orgs')->get()->sortBy('name');

        $categories = [
            'technologies' => [
                'emerging' => Technology::where('subcategory', 'Emerging')->get(),
                'stable' => Technology::where('subcategory', 'Stable')->get(),
                'accelerating' => Technology::where('subcategory', 'Accelerating')->get(),
            ],
            'industries' => $industries->chunk(max(1, ceil($industries->count() / 4))), // max for case where count() == 0
            'tags' => $tags->chunk(max(1, ceil($tags->count() / 4))), // max for case where count() == 0
            //'domains' => Domain::all()->groupBy('industry_id')->chunk(3),
        ];

        //dd($categories['industries']);

        $top_contributors = $users->sortBy(function ($user, $key) {
            $org_count = $user->orgs()->count();
            $user['org_count'] = $org_count;
            return -$org_count; // reversed
        })->take(5);

        $top_commentors = $users->sortBy(function ($user, $key) {
            $comment_count = $user->comments()->count();
            $user['comment_count'] = $comment_count;
            return -$comment_count; // reversed
        })->take(5);

        $stats = [
            'Organisations' => $orgs->count(),
            'Discussions' => $discussions->count(),
            'Comments' => $comments->count(),
            'Users' => $users->count(),
        ];

        $orgs = $orgs->sortByDesc('id')->take(4);
        $discussions = $discussions->sortByDesc('id')->take(4);

        return view('pages.home', compact('orgs', 'discussions', 
            'top_contributors', 'top_commentors', 'stats', 'categories'));
    }

    /**
     * Display the specified technology.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function technology($id)
    {
        $technology = Technology::findOrFail($id);

        $orgs = $technology->orgs()->paginate($this->paginate);
        $type = 'Technology';
        $category = $technology->name;

        return view('pages.orgs', compact('category', 'type', 'orgs'));
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

        $orgs = $industry->orgs()->paginate($this->paginate);
        $type = 'Industry';
        $category = $industry->name;

        return view('pages.orgs', compact('category', 'type', 'orgs'));
    }

    // /**
    //  * Display the specified domain.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function domain($id)
    // {
    //     $category = Domain::findOrFail($id);
    //     $type = 'Domain';

    //     // get domains with same alias
    //     $domains = Domain::where('alias', $category->alias)->get();

    //     foreach($domains as $domain)
    //     {
    //         foreach($domain->orgs as $org)
    //         {
    //             $org_ids[] = $org->pivot->org_id;
    //         }
    //     }
    //     // return 404 if no ids found
    //     if (empty($org_ids)) return abort(404);

    //     $orgs = Org::whereIn('id', $org_ids)->paginate($this->paginate);

    //     return view('pages.category', compact('category', 'type', 'orgs'));
    // }

    /**
     * Display the specified tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tag($id)
    {
        $tag = Tag::findOrFail($id);

        $orgs = $tag->orgs()->paginate($this->paginate);
        $type = 'Application';
        $category = $tag->name;

        return view('pages.orgs', compact('category', 'type', 'orgs'));
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
        $type = 'User';
        $category = $user->getNameAndCity();

        return view('pages.orgs', compact('category', 'type', 'orgs'));
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
        $type = 'User';
        $category = $user->getNameAndCity();

        return view('pages.discussions', compact('category', 'type', 'discussions'));
    }
}
