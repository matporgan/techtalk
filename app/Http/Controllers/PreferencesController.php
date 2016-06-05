<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Session;

class PreferencesController extends Controller
{
    /**
     * Display the users preferences.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (! Auth::check()) return redirect('login');
        
        $user = Auth::user();
        
        return view('pages.account', compact('user'));
    }
    
    /**
     * Update the notification frequency for the user
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateNotify(Request $request)
    {
        if (! Auth::check()) return redirect('login');
        
        $user = Auth::user();
        
        $user->update($request->all());
        
        Session::flash('success', 'Notification preferences updated!');
        
        return back();
    }
    
    /**
     * Update the password for the user
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        if (! Auth::check()) return redirect('login');
        
        $user = Auth::user();
        
        $user->update(['password' => bcrypt($request->password)]);
        
        Session::flash('success', 'Password updated!');
        
        return back();
    }
}
