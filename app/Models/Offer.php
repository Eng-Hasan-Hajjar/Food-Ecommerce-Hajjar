<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
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


    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'from', 'to', 'image', 'resturant_id');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}
