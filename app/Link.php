<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	/**
	 * Fillable fields for a link.
	 *
	 * @var array
	 */
    protected $fillable = [
    	'description', 
    	'url'
    ];

    /**
     * Get the org associated with the given link.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function org()
    {
    	return $this->belongsTo('App\Org');
    }
}
