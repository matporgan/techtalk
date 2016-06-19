<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Nqxcode\LuceneSearch\Model\SearchableInterface;
use Nqxcode\LuceneSearch\Model\SearchTrait;

class Discussion extends Model implements SearchableInterface
{
    use SearchTrait;
 
    /**
     * Get id list for all searchable models.
     */
    public static function searchableIds()
    {
        return self::lists('id');
    }

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
