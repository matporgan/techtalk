<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\Comment;
use App\User;
use App\Org;

class CommentsController extends Controller
{
    /**
     * Add comment to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $parent_id) 
    {
        // authenticate and retrieve user
    	if(($user = Auth::user()) == null) { abort(403); }

        // check for no parent
        $parent_id = ($parent_id == 0 ? null : $parent_id);

        // create DB entry
        $comment = new Comment;
        $comment->body = $request->body;
       	$comment->org()->associate($id);
       	$comment->user()->associate($user);
        $comment->parent()->associate($parent_id);
       	$comment->save();

        return back();
    }
}
