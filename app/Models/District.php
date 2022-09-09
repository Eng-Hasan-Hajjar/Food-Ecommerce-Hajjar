<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $table = 'districts';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');



    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function resturants()
    {
        return $this->hasMany('App\Models\Resturant');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

}
