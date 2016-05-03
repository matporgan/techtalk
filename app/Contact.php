<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
	 * Fillable fields for a link.
	 *
	 * @var array
	 */
    protected $fillable = [
    	'name', 
    	'email'
    ];

    /**
     * Get the org associated with the given contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function org()
    {
    	return $this->belongsTo('App\Org');
    }
}
