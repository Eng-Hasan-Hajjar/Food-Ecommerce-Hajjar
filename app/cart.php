<?php

namespace App;
use App\Models\Resturant;

class  cart {

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $resturant = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->resturant = $oldCart->resturant;
        }
    }


    public function add($item, $id) {
       // dd(session()->get('cart'));
        $storedItem = ['qty' => 1 ,  'price' => '', 'notes'=>'' , 'item' => $item];
        if ($this->items) {
            $res = $item->resturant_id;
            if (array_key_exists($id, $this->items) || $res !=$this->resturant) { //1
              //  $storedItem = $this->items[$id];
               return false;
            }
        }

        $price = ($item->offering_price==null) ? $item->price  : $item->offering_price;
        $storedItem['price'] = $price ;
        if($this->resturant == 0 ) {
            $this->resturant = $item->resturant_id;
        }
        $this->items[$id] = $storedItem;

        $this->totalQty++;
        $this->totalPrice += $price;
        return true;
    }

    public function updateQty($id , $num){
        if($num > 0) {
            $this->items[$id]['qty'] = $num;
              if($this->items[$id]['item']['offering_price']){
                  $price = $this->items[$id]['item']['offering_price'];
              }
              else{
                  $price = $this->items[$id]['item']['price'];
              }
            $this->items[$id]['price'] = $price * $num;
            $total = collect($this->items)->sum('price');
            $this->totalPrice = $total;
        }
    }


    public function removeItem($id) {
        $this->totalQty -= 1;
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
        if(count($this->items) == 0)
            $this->resturant = 0;

    }

}


