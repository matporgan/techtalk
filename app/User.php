<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name',
        'office_city',
        'email', 
        'password',
        'notify_frequency',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    
    /**
     * Get users fullname
     * 
     * @return string
     */
    public function getName()
    {
        return $this->first_name . " " . $this->last_name;
    }
    
    /**
     * Get users fullname and city
     * 
     * @return string
     */
    public function getNameAndCity()
    {
        return $this->first_name . " " . $this->last_name . " (" . $this->office_city . ")";
    }
    
    /**
     * Check to see if user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function isAdmin()
    {
        return ($this->role == 'admin' || $this->isSuperAdmin());
    }

    /**
     * Check to see if user is a super admin.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function isSuperAdmin()
    {
        return $this->role == 'superadmin';
    }

    /**
     * Get the orgs associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orgs()
    {
        return $this->belongsToMany('App\Org', 'org_user', 'user_id', 'org_id')->withPivot('org_role', 'watcher')->withTimestamps();
    }

    /**
     * Get the discussions associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function discussions()
    {
        return $this->hasMany('App\Discussion');
    }

    /**
     * Get the comments associated with the given user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
