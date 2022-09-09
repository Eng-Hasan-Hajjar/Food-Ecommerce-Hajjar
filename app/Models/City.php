<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function getDistrictAttribute($cityId){
        return $this->districts()->where('city_id',$cityId);
    }

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }

}
