<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;

use Gate;
use Session;

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
        // authorization
        $org = Org::findOrFail($id);
        if (Gate::denies('update-org', $org)) { abort(403); }

        // create DB entry
        $request->merge(array('relationship' => trim($request->relationship)));
        $org->contacts()->create($request->all());
        
        Session::flash('success', 'Contact successfully added!');
        return back();
    }

    /**
     * Update the specified contact.
     *
     * @param  Request $request
     * @param  int  $id
     * @param  int  $contact_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $contact_id)
    {
        // authorization
        $org = Org::findOrFail($id);
        if (Gate::denies('update-org', $org)) abort(403);

        // update database entry
        $request->merge(array('relationship' => trim($request->relationship)));
        $contact = Contact::findOrFail($contact_id);
        $contact->update($request->all());

        // flash and redirect
        Session::flash('success', 'Successfully updated!');
        return redirect("/orgs/{$org->id}");
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
