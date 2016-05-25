<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	/**
	 * Fillable fields for a document.
	 *
	 * @var array
	 */
    protected $fillable = [
    	'name',
        'ext',
    	'description', 
    	'path'
    ];

    /**
     * Get the org associated with the given document.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function org()
    {
    	return $this->belongsTo('App\Org');
    }
}
