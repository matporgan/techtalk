<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

use App\Org;
use App\Document;

trait AuthorizesUsers {

	/**
	 * 
	 */
	protected function isUserLegit($id) 
    {
        return Org::where([
            'id' => $id,
            'user_id' => \Auth::id()
        ])->exists();
    }
    
    /**
     * 
     */
    protected function unauthorized()
    {
        return back();
    }
}