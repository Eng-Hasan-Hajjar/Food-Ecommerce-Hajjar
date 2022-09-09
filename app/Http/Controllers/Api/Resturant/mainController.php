<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;

class mainController extends Controller
{

    // validate products
    protected  function validateProduct($request){
        return validator()->make($request->all(),[

            "name"=>"required",
            "description" =>"required",
            "price"=>"required",
            "duratrion"=>"required",
            "image" => "required",
        ]);


    }
    // validate offers
    protected  function validateOffer($request){
        return validator()->make($request->all(),[

            "name"=>"required",
            "description" =>"required",
            "from"=>"required",
            "to"=>"required",
            "image" => "required",
        ]);

    }

    //========================== products
    // show all  product  or get one product
    public function products(Request $request){
        $products =$request->user()->products()->where(function($q) use ($request){
            if($request->has('id')){
                $q->where('id',$request->id);
            }
        })->get();
        return responseJson("1" , "المنتجات", $products );
    }
    //create product
    public function createProduct(Request $request){
        if($v=$this->validateProduct($request)->fails()){
            return responseJson(0,$v->errors()->first(),$v->errors());
        }
        $product = $request->user()->products()->create($request->all());
        return responseJson("1" ,  "تم" ,$product);
    }
    //update  product
    public function updateProduct(Request $request){
        if($v = $this->validateProduct($request)->fails()){
            return responseJson(0,$v->errors()->first(),$v->errors());
        }
        $product = $request->user()->products()->find($request->id);
        if($product){
           $product->update($request->except(['api_token','id']));
            return responseJson("1" ,  "تم" ,$product);
        }
        else{
            return responseJson("0" ,  "no Product related with this id");
        }


    }

    // ==========================  offers

    // show all  offers or get one offer function
    public function offers(Request $request){

        $products =$request->user()->offers()->where(function ($query) use ($request){
            if($request->has("id"))
            {
                $query->where("id",$request->id);
            }
        })->get();
        return responseJson("1" , "offers", $products );
    }

    //create offer
    public function createOffer(Request $request){
        if($v = $this->validateOffer($request)->fails()){
            return responseJson(0,$v->errors()->first(),$v->errors());
        }
        $offer = $request->user()->offers()->create($request->all());
        return responseJson("1" ,  "تم" ,$offer);
    }
    //update  offer
    public function updateOffer(Request $request){
        if($v = $this->validateOffer($request)->fails()){
            return responseJson(0,$v->errors()->first(),$v->errors());
        }
        $offer = $request->user()->offers()->find($request->id);
        if($offer){
            $offer->update($request->except(['api_token','id']));
            return responseJson("1" ,  "تم" ,$offer);
        }
        else{
            return responseJson("0" ,  "no offer related with this id");
        }


    }

    //================================= orders
    /* pending  order  */
    public  function pendingOrder(){
        $orders = Order::where('resturant_id',auth('api_resturant')->user()->id)->where('state','pending')->get();
        if(count($orders)){
            return responseJson('1','success' , $orders);
        }
        return responseJson(0,'no order yet ');
    }
    /* current order  */
    public  function currentOrder(){
        $orders = Order::where('resturant_id',auth('api_resturant')->user()->id)->whereIn('state',['accepted'])->get();
        if(count($orders)){
            return responseJson('1','success' , $orders);
        }
        return responseJson(0,'no order yet ');
    }
    /*  old order  */
    public  function oldOrder(){
        $orders = Order::where('resturant_id',auth('api_resturant')->user()->id)->whereNotIn('state',['pending','accepted'])->get();

        if(count($orders)){
            return responseJson('1','success' , $orders);
        }
        return responseJson(0,'no order yet ');
    }

    /* accept  order  */
    public function acceptOrder(Request $request){
        Order::where('resturant_id',auth()->user()->id)->where('id',$request->order_id)->update([
            'state' => 'accepted'
        ]);
        $order_id = $request->order_id;
        $client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
        $client = Client::find($client_id[0]);
        /* notifications  */
        return notify($client,$request->user()->name.'  accepted order ',
            $order_id,"accepted order",'client');
        /* end notifications  */
    }
    /* delivered  order  */
    public function deliveredOrder(Request $request){
        Order::where('resturant_id',auth()->user()->id)->where('id',$request->order_id)->update([
            'state' => 'delivered'
        ]);
        $order_id = $request->order_id;
        $client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
        $client = Client::find($client_id[0]);
        /* notifications  */
        return notify($client,$request->user()->name.'  accepted order ',
            $order_id,"delivered order",'client');
        /* end notifications  */
    }
    /* reject order  */
    public function rejectOrder(Request $request){
        Order::where('resturant_id',auth()->user()->id)->where('id',$request->order_id)->update([
            'state' => 'rejected'
        ]);
        $order_id = $request->order_id;
        $client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
        $client = Client::find($client_id[0]);
        /*============================ notifications  */
        return notify($client,$request->user()->name.'  rejected order ',
            $order_id,"reject  order" , 'client');
        /* end notifications  */
    }

    /* commission */
    public  function commission (){

        $sales = Order::where('resturant_id',auth('api_resturant')->user()->id)->where('state','delivered')
        ->sum('total');
        $commission = $sales / settings()->getAttribute('commission') /100;
        $paid = Payment::where('resturant_id',auth('api_resturant')->user()->id)
            ->sum('paid');
        $data= [
            'text1' => settings()->getAttribute('text_up'),
            'sales' => $sales,
            'commission' => $commission,
            'paid' => $paid,
            'rest' =>   $commission - $paid,
            'text2' => settings()->getAttribute('text_down'),

        ];
        return responseJson('1','sales',$data);




    }
    // list notifications
    public function notification(){
        $notification = auth('api_resturant')->user()->notifications()->get();
        return responseJson(1,"success" , $notification);
    }



}
