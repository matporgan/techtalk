<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    public function scopeWithName($query, $name)
	{
        return $query->where(compact('name'));
	}
}
