<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
	/**
	 * Fillable fields for a phase.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Get the orgs associated with the given phase.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function orgs()
    {
    	return $this->belongsToMany('App\Org', 'org_phase', 'phase_id', 'org_id');
    }
}
