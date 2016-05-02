<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
    	'name', 
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
