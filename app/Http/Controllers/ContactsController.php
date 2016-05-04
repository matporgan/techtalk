<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Traits\AuthorizesUsers;

use App\Contact;
use App\Org;

class ContactsController extends Controller
{
    use AuthorizesUsers; 

    /**
     * Add contact to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request, $id) 
    {
        if(! $this->isUserLegit($id)) 
        {
            return $this->unauthorized();
        }
        
        $org = Org::findOrFail($id);

        // create DB entry
        $org->contacts()->create([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        return redirect("/orgs/{$org->id}");
    }

    /**
     * Destroy the contact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($org_id, $contact_id) {
        if(! $this->isUserLegit($org_id)) 
        {
            return $this->unauthorized();
        }
        
    	Contact::destroy($contact_id);
    	return back();
    }
}
