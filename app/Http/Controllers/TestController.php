<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Notifications;
use App\Discussion;
use App\User;
use Beautymail;
use Auth;
use Mail;

class TestController extends Controller
{
    public function start()
    {
        $discussions = Discussion::all();
        $user = User::first();

        // $user = Auth::user();

        // $d1 = Discussion::where('id', 3)->first();
        // $d1->newComments = 2;

        // $discussions = array();
        // $discussions[] = $d1;

        // //dd($discussions);

        // Mail::send('emails.test', ['user' => $user], function ($m) use ($user) {
        //     $m->from('techtalk@advisian.com', 'Tech Talk');
        //     $m->to($user->email, $user->name)->subject('Test Email abc!');
        // });

        Mail::send('emails.notification1', ['user' => $user, 'discussions' => $discussions], function ($m) use ($user) {
            $m->from('techtalk@advisian.com', 'Tech Talk');
            $m->to($user->email, $user->name)->subject('Tech Talk Notifications');
        });

        return view('emails.notification1', compact('discussions'));
    }
}
