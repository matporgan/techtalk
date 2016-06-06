<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Notifications;
use Beautymail;
use Auth;
use Mail;

class TestController extends Controller
{
    public function start()
    {
        $user = Auth::user();

        Mail::send('emails.test', ['user' => $user], function ($m) use ($user) {
            $m->from('techtalk@advisian.com', 'Tech Talk');
            $m->to($user->email, $user->name)->subject('Test Email abc!');
        });
    }
}
