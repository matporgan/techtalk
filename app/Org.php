<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
	/**
	 * Fillable fields for a flyer.
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
}
