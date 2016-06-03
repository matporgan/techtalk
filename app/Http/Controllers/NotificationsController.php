<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Mail;

class NotificationsController extends Controller
{
    /**
     * Send an e-mail to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmail()//Request $request, $id)
    {
        $user = Auth::user();
        // $user = User::findOrFail($id);

        Mail::send('emails.test', ['user' => $user], function ($m) use ($user) {
            $m->from('techtalk@advisian.com', 'Tech Talk');

            $m->to($user->email, $user->name)->subject('Test Email!');
        });
    }
}
