<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\Discussion;

class DiscussionsController extends Controller
{
    /**
     * Show the form for creating a new discussion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect if not logged in
        if (! Auth::check()) return redirect('register');

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
        $discussion->save();

        return redirect("/discussions/{$discussion->id}");
    }

	/**
     * Display a listing of the discussions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_discussions = Discussion::with('comments')->get();

        
        // get every discussion that has comments
        $discussions = null;
        foreach($all_discussions as $discussion)
        {
            if($discussion->comments->first() != null)
            {
                $latest_comment = $discussion->comments()->orderBy('id', 'desc')->first();
                $timestamp = $latest_comment->created_at->timestamp;
                $discussions[$timestamp] = $discussion;
            }     
            elseif($discussion->type != 'Organisation')
            {
                $timestamp = $discussion->created_at->timestamp;
                $discussions[$timestamp] = $discussion;
            }            
        }

        if(! is_null($discussions))
        {
            // reverse array so newest are first
            krsort($discussions);
        }

        return view('pages.discussions', compact('discussions'));
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
