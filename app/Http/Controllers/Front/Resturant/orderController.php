<?php

namespace App\Http\Controllers\Front\Resturant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderBroduct;
use Illuminate\Http\Request;

class orderController extends Controller
{
    //================================= orders
    /* pending  order  */
    public function pendingOrder()
    {
        $orders = Order::where('resturant_id', auth('resturant')->user()->id)->where('state', 'pending')->get();
        return view('front.resturants.orders.new', compact('orders'));
    }

    /* current order  */
    public function currentOrder()
    {
        $orders = Order::where('resturant_id', auth('resturant')->user()->id)->whereIn('state', ['accepted'])->get();
        return view('front.resturants.orders.current', compact('orders'));
    }

    /*  old order  */
    public function oldOrder()
    {
        $orders = Order::where('resturant_id', auth('resturant')->user()->id)->whereNotIn('state', ['pending', 'accepted'])->get();
        return view('front.resturants.orders.old', compact('orders'));

    }



    /* accept  order  */
    public function acceptOrder(Request $request)
    {
        Order::findOrFail($request->order_id);
        Order::where('resturant_id', auth()->user()->id)->where('id', $request->order_id)->update([
            'state' => 'accepted'
        ]);
        alert()->success('', 'تم استلام الطلب وسوف يتم اخبار العميل بانك تقوم بتجهيزه');
        return back();
        //$client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
        //$client = Client::find($client_id[0]);

        /* notifications  */
//        return notify($client,$request->user()->name.'  accepted order ',
//            $order_id,"accepted order",'client');
        /* end notifications  */
    }

    /* reject order  */
    public function rejectOrder(Request $request)
    {
        Order::findOrFail($request->order_id);
        Order::where('resturant_id', auth()->user()->id)->where('id', $request->order_id)->update([
            'state' => 'rejected'
        ]);
        alert()->info('', 'تم رفض الطلب  وسيتم اخبار العميل  بذلك');
        return back();
//        $order_id = $request->order_id;
//        $client_id = Order::where('id',$request->order_id)->pluck('client_id')->toArray();
//        $client = Client::find($client_id[0]);
        /*============================ notifications  */
//        return notify($client,$request->user()->name.'  rejected order ',
//            $order_id,"reject  order" , 'client');
        /* end notifications  */
    }


    /* delivered  order  */
    public function deliveredOrder(Request $request)
    {
        Order::findOrFail($request->order_id);
        Order::where('resturant_id', auth()->user()->id)->where('id', $request->order_id)->update([
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
