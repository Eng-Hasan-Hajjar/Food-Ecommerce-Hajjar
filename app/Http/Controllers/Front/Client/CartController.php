<?php

namespace App\Http\Controllers\Front\Client;

use App\cart;
use App\Http\Controllers\Controller;
use App\Models\OrderBroduct;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        $cart = Session::get('cart');
        return view('front.clients.cart',compact('cart'));
    }



    // Add to cart
    public  function getAddToCart(Request $request , $id){
         $product = Product::findOrFail($id);
         $olCart = Session::has('cart') ? Session::get('cart') : null ;
         $cart = new cart($olCart);

        if(!$cart->add($product,$id)){
            alert()->info('', 'لا يمكن  اضافه ذلك المنتج الا بعد انتهاء الطلب  السابق');
            return redirect()->back();
        }
         $request->session()->put('cart' , $cart);
        alert()->success('', 'تم اضافه ذلك المنتج الي  السلة');

        return redirect()->back();
    }

    public function updateQty(){
        $id = $_POST['id'];
        $qty = $_POST['q'];
        $olCart = Session::has('cart') ? Session::get('cart') : null ;
        $cart = new cart($olCart);
        $cart->updateQty($id , $qty);
       session()->put('cart' , $cart);
        return $cart->totalPrice;
    }


    public function deleteProduct($id){
        Product::findOrFail($id);
        $olCart = Session::has('cart') ? Session::get('cart') : null ;
        $cart = new cart($olCart);
         $cart->removeItem($id);
        session()->put('cart' , $cart);
        return redirect()->back();
    }

    // Submit Order
        public function submitOrder(){

         $cart  = session()->get('cart');
            $resturant = Resturant::find($cart->resturant);
            $sum = $resturant->delivery_charge+$cart->totalPrice;
            // check  if  close  or  open
            if($resturant->state == 0){
                return  responseJson(0, 'ناسف لعدم اكتمال العملية :(  المطعم مغلق !!');
            }
           return responseJson(1 , 'sucess' , ['cart'=>$cart,'delivery'=>$resturant->delivery_charge,'sum'=>$sum]);
        }

        // newOrder
    public function newOrder(Request $request){
        $this->validate($request , [
         'address' => 'required|max:255',
            'notes' => 'max:255'
        ],[
            'address.required' =>'لابد من كتابه عنوانك',
            '.max' =>'لابد من ادخال قيم صحيحه'
        ]);
        $cart  = session()->get('cart');
        $cost = $cart->totalPrice;  // total price
        // create initial order
            $resturant = Resturant::findOrFail($cart->resturant);
            if($cost < $resturant->minimum_order){
                return responseJson(0 , 'اقل طلب  لابد ان يكن  اكبر من '.$resturant->minimum_order . ' دولار ');
            }
            $order = auth()->user()->orders()->create([
                'resturant_id' => $cart->resturant,
                'notes' => $request->notes,
                'address' => $request->address
            ]);
        // get delivery cost
        $delivery_cost = $resturant->delivery_charge;  //10
        foreach ($cart->items as $i){
            //$product = Product::find($i['item']['id']);
            $ready_product = [
                $i['item']['id']=>[
                    'amount' => $i['qty'],
                    'price' => $i['price'],
//                    'notes' => (isset($i['notes']))? $i['notes'] : ''
                ]
            ];
            // add product in order_product     (pivot_table )   m-to-m
            $order->products()->attach($ready_product);
           // $cost+=($product->price * $i['qty']); //24
        }
        // check  minimum order cost for resturant

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
        $details = '
<section class="twe-order-info footer-bottom">
    <div class="container">
        <h2 class="text-center m-2"> تفاصيل الطلب</h2>
        <div class="name-res text-right d-flex flex-row" style="background: #ececec">
            <div >
                <img class="h-100 rounded-circle"  src="'.asset('images/profile/'.$order->resturant->image).'">
            </div>
            <div >
                <h3 >كنتاكي </h3>
                <p>:  يوم <span>'.$order->created_at.'</span></p>
            </div>
        </div>
        <div class="adderrs d-flex" style="background: #ececec">
            <h4 > العنوان :</h4>
            <p>'.$order->address.', '.$order->client->district->name.', '.$order->client->district->city->name.'</p>
        </div>
        <div class="row meal-info text-right" style="background: #ececec">
            <div  class="col col-12">
                <h3>تفاصيل الطلب</h3>
            </div >
            ';
             foreach ($cart->items as $i) {
                 $details .= '<div class="col col-6">
                               <p>' . $i['item']['name'] . '</p>
                             </div>
            <div class="col col-6 text-center">
                <p>' .$i['price'].' ريال</p>
            </div>';
                 }
        $details.='
        </div>
        <div class="total text-right" style="background: #ececec">
            <p>سعر الطلب :<span class="text-center">'.$order->cost.'</span></p>
            <p>رسم التوصيل :<span>'.$order->delivery_cost.' ريال</span></p>
            <p> الاجمالي   :<span>'.$order->total.' ريال</span></p>
            <p> الدفع   :<span>كاش </span></p>

        </div>
    </div>
</section>
             ';
        \session()->forget('cart');
        return $details;
//            return notify($resturant,'you have new order from user '.$request->user()->name,
//                $order->id,"new order",'resturant');



    }

}
