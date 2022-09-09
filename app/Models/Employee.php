<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = true;
    protected $fillable = array('name', 'phone','address','age','resume','resturant_id');


    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }
}
