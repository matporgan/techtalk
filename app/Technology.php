<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
	/**
	 * Fillable fields for a technology.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Get the orgs associated with the given technology.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function orgs()
    {
    	return $this->belongsToMany('App\Org', 'org_technology', 'technology_id', 'org_id');
    }
}
