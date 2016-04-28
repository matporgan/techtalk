<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
	/**
	 * Fillable fields for an org.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'logo',
		'short_desc',
		'long_desc',
		'website'
	];

    public function scopeWithName($query, $name)
	{
        return $query->where(compact('name'));
	}

	/**
	 * Get the technologies associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function technologies()
    {
    	return $this->belongsToMany('App\Technology', 'org_technology', 'org_id', 'technology_id');
    }

    /**
     * Get a list of technology ids associated with the current organisation.
     *
     * @return array 
     */
    public function getTechnologyListAttribute()
    {
    	return $this->technologies->lists('id')->all();
    }

	/**
	 * Get the industries associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function industries()
    {
    	return $this->belongsToMany('App\Industry', 'org_industry', 'org_id', 'industry_id');
    }

    /**
     * Get a list of technology ids associated with the current organisation.
     *
     * @return array 
     */
    public function getIndustryListAttribute()
    {
    	return $this->industries->lists('id')->all();
    }
    
    /**
	 * Get the cycles associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function cycles()
    {
    	return $this->belongsToMany('App\Cycle', 'org_cycle', 'org_id', 'cycle_id');
    }

    /**
     * Get a list of technology ids associated with the current organisation.
     *
     * @return array 
     */
    public function getCycleListAttribute()
    {
    	return $this->cycles->lists('id')->all();
    }

    /**
	 * Get the phases associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function phases()
    {
    	return $this->belongsToMany('App\Phase', 'org_phase', 'org_id', 'phase_id');
    }

    /**
     * Get a list of technology ids associated with the current organisation.
     *
     * @return array 
     */
    public function getPhaseListAttribute()
    {
    	return $this->phases->lists('id')->all();
    }

	/**
	 * Get the tags associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
    {
    	return $this->belongsToMany('App\Tag', 'org_tag', 'org_id', 'tag_id');
    }

    /**
     * Get a list of technology ids associated with the current organisation.
     *
     * @return array 
     */
    public function getTagListAttribute()
    {
    	return $this->tags->lists('id')->all();
    }

}
