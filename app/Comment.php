<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Nqxcode\LuceneSearch\Model\SearchableInterface;
use Nqxcode\LuceneSearch\Model\SearchTrait;

class Comment extends Model implements SearchableInterface
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
    	'body',
        'user_id',
        'org_id'
    ];

    protected $level;

    protected $parentName;

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getLevel()
    {
        return $this->level;
    }
    
    public function setParentName($name)
    {
        $this->parentName = $name;
    }

    public function getParentName()
    {
        return $this->parentName;
    }

    /**
     * Get the discussion associated with the given comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function discussion()
    {
    	return $this->belongsTo('App\Discussion');
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
        return $this->belongsTo('App\Comment');
    }
}
