<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	/**
	 * Fillable fields for a comment.
	 *
	 * @var array
	 */
    protected $fillable = [
    	'body',
        'user_id',
        'org_id'
    ];

    /**
     * Get the org associated with the given comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function org()
    {
    	return $this->belongsTo('App\Org');
    }

    /**
     * Get the user associated with the given comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the parent associated with the given comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }

    /**
     * Get the children associated with the given comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function children()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }
}
