<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Resturant;
use App\Models\Review;
use Dotenv\Validator;
use Illuminate\Http\Request;

class maincontroller extends Controller
{

    // list resturants   or filter by city id a and resturant name
    public function showResturants(Request $request){

        $resturants = Resturant::where(function ($q) use($request){
            if($request->has('resturant')){
                $q->where('name','like', '%' . $request->resturant . '%');
            }
        })->WhereHas('district',function ($q) use ($request){
            if($request->has('city')) {
                $q->where('districts.city_id', $request->city);
            }
        })->get();

        // return reviews for resturant by an Accessor   (getReviewAttribute in resturant model )
        $data = array();
        foreach ($resturants as $resturant){
             array_push($data,[
                 'data' => $resturant,
                 'resturant_rate' => $resturant->review
             ]);

        }
        return responseJson(1,"success" , $data);
    }

    // lists of  food  for  particular food
    public function listProducts(Request $request){
        $products  =  Product::whereHas('resturant' ,function ($q) use($request){
            $q->where('resturants.id' , $request->id);
        })->get();
       return responseJson(1,'success',$products);
    }

    // all Comments and Reviews
    public function commentReview(Request $request){
        $review  =  Review::whereHas('resturant' ,function ($q) use($request){
            $q->where('resturants.id' , $request->id);
        })->get();
        return responseJson(1,'success',$review);
    }

    //  create review
    public  function  createReview(Request $request){
        $validate = validator()->make($request->all(),[

            "reate" => "required",
            "comment" => "required",
            "resturant_id"=>"required|exists:resturants,id"
        ]);
        if($validate->fails()){
            return responseJson(0,$validate->errors()->first(),$validate->errors());
        }
        $review = $request->user()->reviews()->create($request->all());
        return responseJson(1,'success'  , $review);
    }

    // info about  particular resturant
    public  function  infoResturant(Request $request){
        $info = Resturant::where('id',$request->id)->get();
        return responseJson(1,"0" , $info);
    }


    // =================================== orders
           /* create order */
    public function newOrder(Request $request){

        $validate = validator()->make($request->all(),[
            "resturant_id" => "required|exists:resturants,id",
            "products.*.product_id" => "required|exists:products,id",
            "products.*.quantity" => "required",
            "address"=>"required",
            "payment_method" => "required|in:cash,online"
        ]);
        if($validate->fails()){
            return responseJson(0,$validate->errors()->first(),$validate->errors());
        }
        // get resturant who deal with it
        $resturant = Resturant::find($request->resturant_id);
        // check  if  close  or  open
        if($resturant->state == 0){
          return  responseJson(0, 'this resturant is colsed   please try again');
        }
        // create initial order
        $order = $request->user()->orders()->create([
            'resturant_id' => $request->resturant_id,
            'payment_method' => $request->payment_method,
            'address'=>$request->address
        ]);

        $cost = 0;

        // get delivery cost
        $delivery_cost = $resturant->delivery_charge;  //10
        foreach ($request->products as $i){

            $product = Product::find($i['product_id']);
            $ready_product = [
              $i['product_id']=>[
                  'amount' => $i['quantity'],
                  'price' => $product->price,
                  'notes' => (isset($i['note']))? $i['note'] : ''
              ]
            ];
            // add product in order_product     (pivot_table )   m-to-m
             $order->products()->attach($ready_product);
            $cost+=($product->price * $i['quantity']); //24
        }
           // check  minimum order cost for resturant
        if($cost >= $resturant->minimum_order){

                 //calc total cost
            $total = $cost + $delivery_cost; //34
                 // calc commission for app
            $commission = settings()->commission * $cost;  // 24*0.1
                //calc  rest of the cost
            $net  = $total - $commission;   //34 - 0
            /* update order  */
            $update = $order->update([
                'cost'=> $cost,
                'delivery_cost' =>$delivery_cost,
                'commission' =>$commission,
                'net' => $net,
                'total' =>$total
            ]);


          return notify($resturant,'you have new order from user '.$request->user()->name,
                $order->id,"new order",'resturant');
        }
        else{
            $order->products()->delete();
            $order->delete();
            return responseJson(0 , 'must order larger than '.$resturant->minimum_order.'Real');
        }


    }
           /* current order  */
    public  function currentOrder(){
        $orders = Order::where('client_id',auth('api_client')->user()->id)->where('state','accepted')->get();
        if(count($orders)){
            return responseJson('1','success',$orders);
        }
        return responseJson(0,'no order yet ');
    }
        /*  old order  */
    public  function oldOrder(){
        $orders = Order::where('client_id',auth('api_client')->user()->id)->whereNotIn('state',['pending','accepted'])->get();

        if(count($orders)){
            return responseJson('1','success' , [$orders]);
        }
        return responseJson(0,'no order yet ');
    }

    /* accept  order  */

    public function acceptOrder(Request $request){
        Order::where('client_id',auth()->user()->id)->where('id',$request->order_id)->update([
            'state' => 'delivered'
        ]);
        $order_id = $request->order_id;
        $resturant_id = Order::where('id',$request->order_id)->pluck('resturant_id')->toArray();
        $resturant = Resturant::find($resturant_id[0]);
        /* notifications  */
        return notify($resturant,$request->user()->name.'  accepted order ',
            $order_id,"delivered order",'resturant');
        /* end notifications  */
    }

    /* reject order  */
    public function rejectOrder(Request $request){
        Order::where('client_id',auth()->user()->id)->where('id',$request->order_id)->update([
            'state' => 'declined'
        ]);
        $order_id = $request->order_id;
        $resturant_id = Order::where('id',$request->order_id)->pluck('resturant_id')->toArray();
        $resturant = Resturant::find($resturant_id[0]);
        /* notifications  */
        return notify($resturant,$request->user()->name.'  rejected order ',
            $order_id,"declined order",'resturant');
        /* end notifications  */
    }

    //============================================= offers      */
              /* list offers */
    public function offers(){
        $offers = Offer::all();
        return responseJson('1', 'success',$offers);
    }
    // list notifications
    public function notification(){
        $notification = auth('api_client')->user()->notifications()->get();
        return responseJson(1,"success" , $notification);
    }

}
