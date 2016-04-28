<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
	/**
	 * Fillable fields for an industry.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * Get the orgs associated with the given industry.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function orgs()
    {
    	return $this->belongsToMany('App\Org', 'org_industry', 'industry_id', 'org_id');
    }
}
