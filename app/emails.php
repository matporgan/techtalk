<?php

use App\Users;

function sendEmail() {
    $users = User::all();
    
    foreach($users as $user) {
        Mail::send('emails.test', ['user' => $user], function ($m) use ($user) {
            $m->from('techtalk@advisian.com', 'Tech Talk');
    
            $m->to($user->email, $user->name)->subject('Test Email!');
        });
    }
}