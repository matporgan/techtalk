<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Notifications;
use Beautymail;

class TestController extends Controller
{
    public function start()
    {
        // Notifications::send();
        
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.test', [], function($message)
        {
            $message
                ->from('techtalk@advisian.com', 'Tech Talk')
                ->to('test@test.com', 'Test')
                ->subject('Test Email!');
        });
    }
}
