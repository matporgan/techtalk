<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	/**
	 * Fillable fields for a comment.
	 *
	 * @var array
	 */
    protected $fillable = [
    	'name',
        'type',
        'prompt'
    ];

    /**
     * Get the org associated with the given discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function org()
    {
        return $this->belongsTo('App\Org');
    }

    /**
     * Get the user associated with the given discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comments associated with the given discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
