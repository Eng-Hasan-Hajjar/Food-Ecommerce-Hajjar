<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'district_id', 'password', 'image', 'api_token','pin_code');
    protected $hidden = array('api_token','password');

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
