<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;

use Gate;

use App\Contact;
use App\Org;

class ContactsController extends Controller
{
    /**
     * Add contact to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) 
    {
        $org = Org::findOrFail($id);

        // authorization
        if (Gate::denies('update-org', $org)) { abort(403); }

        // create DB entry
        $org->contacts()->create([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        return back();
    }

    /**
     * Destroy the contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $contact_id) {
        $org = Org::findOrFail($id);
        
        // authorization
        if (Gate::denies('update-org', $org)) { abort(403); }
        
    	Contact::destroy($contact_id);
        
    	return back();
    }
}
