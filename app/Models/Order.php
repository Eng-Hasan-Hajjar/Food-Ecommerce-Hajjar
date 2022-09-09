<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('special_order','net','delivery_cost','address' ,'phone', 'amount', 'resturant_id', 'payment_method', 'state', 'total', 'commission', 'cost', 'client_id', 'notes');


    public function getClientAttribute(){
        $client = $this->client()->get()[0];
        // client
        // null
        if ($client)
        {
            return $client;
        }
    }
    public function getResturantAttribute(){
        $resturant = $this->resturant()->get()[0];
        // client
        // null
        if ($resturant)
        {
            return $resturant;
        }
    }




    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('price','amount');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }



}
