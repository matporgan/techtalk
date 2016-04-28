<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
	/**
	 * Fillable fields for a cycle.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Get the orgs associated with the given cycle.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function orgs()
    {
    	return $this->belongsToMany('App\Org', 'org_cycle', 'cycle_id', 'org_id');
    }
}
