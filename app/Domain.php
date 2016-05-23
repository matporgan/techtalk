<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
	/**
	 * Fillable fields for a domain.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'position'
	];

	/**
	 * Get the industry associated with the given domain.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function industry()
    {
    	return $this->belongsTo('App\Industry');
    }

	/**
	 * Get the orgs associated with the given domain.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function orgs()
    {
    	return $this->belongsToMany('App\Org', 'org_domain', 'domain_id', 'org_id')->withTimestamps();
    }
}
