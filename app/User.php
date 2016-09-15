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
        return $this->hasMany('Delta\DeltaService\Devices\DeviceModel', 'device_id', 'users_id');
    }

    public function devices()
    {
        return $this->hasMany('Delta\DeltaService\Devices\DeviceModel', 'device_id', 'users_id');
    }
}
