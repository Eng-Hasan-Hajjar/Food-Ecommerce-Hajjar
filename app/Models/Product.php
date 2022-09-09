<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // get resturant name
    public function getResturantNameAttribute(){
        $resturant = $this->resturant()->pluck('name')[0];
        // client
        // null
        if ($resturant)
        {
            return $resturant;
        }
    }

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'offering_price', 'duratrion', 'image', 'resturant_id');

    public function notHavingImageInDb(){
        return (empty($this->image))?true:false;
        //return true;
    }
    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}
