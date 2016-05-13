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
		'website',
        'in_talks',
        'partner_status'
	];

    public function scopeWithName($query, $name)
	{
        return $query->where(compact('name'));
	}

    /**
     * Get the users associated with the given org.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'org_user', 'org_id', 'user_id')->withPivot('org_role')->withTimestamps();
    }

    /**
     * Get a list of user ids associated with the current org.
     *
     * @return array 
     */
    public function getUserListAttribute()
    {
        return $this->users->lists('id')->all();
    }

	/**
	 * Get the technologies associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function technologies()
    {
    	return $this->belongsToMany('App\Technology', 'org_technology', 'org_id', 'technology_id')->withTimestamps();
    }

    /**
     * Get a list of technology ids associated with the current org.
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
    	return $this->belongsToMany('App\Industry', 'org_industry', 'org_id', 'industry_id')->withTimestamps();
    }

    /**
     * Get a list of technology ids associated with the current org.
     *
     * @return array 
     */
    public function getIndustryListAttribute()
    {
    	return $this->industries->lists('id')->all();
    }

    /**
     * Get the domains associated with the given org.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function domains()
    {
        return $this->belongsToMany('App\Domain', 'org_domain', 'org_id', 'domain_id')->withTimestamps();
    }

    /**
     * Get a list of domain ids associated with the current org.
     *
     * @return array 
     */
    public function getDomainListAttribute()
    {
        return $this->domains->lists('id')->all();
    }

	/**
	 * Get the tags associated with the given org.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
    {
    	return $this->belongsToMany('App\Tag', 'org_tag', 'org_id', 'tag_id')->withTimestamps();
    }

    /**
     * Get a list of tag ids associated with the current org.
     *
     * @return array 
     */
    public function getTagListAttribute()
    {
    	return $this->tags->lists('id')->all();
    }

    /**
     * Get the documents associated with the given org.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany('App\Document');
    }
    
    /**
     * Get the links associated with the given org.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('App\Link');
    }
    
    /**
     * Get the contacts associated with the given org.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    /**
     * Get the discussion associated with the given org.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function discussion()
    {
        return $this->hasOne('App\Discussion');
    }
}
