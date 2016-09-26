<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function devices()
    {
        return $this->belongsToMany('Delta\DeltaService\Devices\DeviceModel', 'users_device', 'users_id', 'device_id');
    }

    public function roles()
    {
        return $this->belongsToMany('Delta\DeltaService\Roles\RoleModel', 'users_role', 'users_id', 'role_id');
    }
}
