<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;
use Session;

use App\Discussion;

class DiscussionsController extends Controller
{
	/**
     * Display a listing of the discussions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // sort discussions by last update
        $discussions = Discussion::with('comments')
            ->where('updated', '!=', 'NULL')
            ->orderBy('updated', 'desc')
            ->paginate(15);

        return view('pages.discussions', compact('discussions'));
    }

    /**
     * Show the form for creating a new discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect if not logged in
        if (Auth::guest()) return redirect()->guest('login');

        return view('discussions.create');
    }

    /**
     * Store a newly created discussion.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // convert 'type' to text
        switch($request->type)
        {
            case 0: $text_type = 'Discussion'; break;
            case 1: $text_type = 'Question'; break;
        }
        $request->merge(['type' => $text_type]);

        $discussion = Discussion::create($request->all());
        $discussion->user()->associate(Auth::user());
        $discussion->updated = time(); // change update time
        $discussion->save();
        
        Session::flash('success', 'Discussion successfully created!');
        return redirect("/discussions/{$discussion->id}");
    }

    /**
     * Display the specified discussion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::with('comments')->findOrFail($id);

        $comments = getOrderedComments($discussion);

        return view('pages.discussion', compact('discussion', 'comments'));
    }
}
