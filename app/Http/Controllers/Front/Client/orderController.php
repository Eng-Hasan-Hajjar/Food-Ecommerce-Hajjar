<?php

namespace App\Http\Controllers\Front\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    //
    /* current order  */
    public function newOrder()
    {
        $orders = Order::where('client_id', auth('web')->user()->id)->get();
        return view('front.clients.orders.new', compact('orders'));
    }

    /*  old order  */
//    public  function oldOrder(){
//        $orders = Order::where('client_id',auth('web')->user()->id)->whereIn('state',['delivered'])->get();
//        return view('front.clients.orders.old',compact('orders'));
//
//    }
//    /* reject order  */
//    public function rejectOrder(Request $request){
//        Order::findOrFail($request->order_id);
//        Order::where('client_id',auth()->user()->id)->where('id',$request->order_id)->update([
//            'state' => 'rejected'
//        ]);
//        alert()->info('', 'تم رفض الطلب  وسيتم اخبار المطعم  بذلك');
//        return back();
////        $order_id = $request->order_id;
////        $client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
////        $client = Client::find($client_id[0]);
//        /*============================ notifications  */
////        return notify($client,$request->user()->name.'  rejected order ',
////            $order_id,"reject  order" , 'client');
//        /* end notifications  */
//    }

    /* delivered  order  */
    public function deliveredOrder(Request $request)
    {
        Order::findOrFail($request->order_id);
        Order::where('client_id', auth()->user()->id)->where('id', $request->order_id)->update([
            'state' => 'delivered'
        ]);
        alert()->success('', 'تم تاكيد  الاستلام');
        return back();
//        $order_id = $request->order_id;
//        $client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
//        $client = Client::find($client_id[0]);
//        /* notifications  */
//        return notify($client,$request->user()->name.'  accepted order ',
//            $order_id,"delivered order",'client');
//        /* end notifications  */
    }


}
