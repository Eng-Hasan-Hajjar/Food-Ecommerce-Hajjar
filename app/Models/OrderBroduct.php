<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBroduct extends Model
{

    protected $table = 'order_product';
    public $timestamps = true;
    protected $fillable = array('product_id', 'order_id','price','amount');

    // get product name
    public function getProductAttribute(){
        $product = $this->product()->pluck('name')[0];
        // client
        // null
        if ($product)
        {
            return $product;
        }
    }


    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    protected $appends = ['product'];
}
