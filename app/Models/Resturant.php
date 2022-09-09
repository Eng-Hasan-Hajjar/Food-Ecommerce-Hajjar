<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Resturant extends Authenticatable
{

    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone','job', 'district_id', 'password','pin_code', 'delivery_charge', 'minimum_order', 'contact_phone', 'whats', 'image', 'state', 'api_token');
    protected $hidden = array('api_token','password');

      // get reviews for resturant
    public function getReviewAttribute(){
        $reviews = $this->reviews()->where('resturant_id',$this->id)->avg('reate');
        // client
        // null
        if ($reviews)
        {
            return $reviews;
        }
        return 0;
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
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
    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }




}
