<?php

namespace App\Http\Controllers\Admin\Order;

use App\DataTables\ordersDataTable;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class orderController extends Controller
{
       //=========================   show all order
    public  function  index(ordersDataTable $dataTable){
        return $dataTable->render('admin.orders.index');
    }

    //================= show order
    public function show($id)
    {
        $record = Order::findOrFail($id);
        return view('admin.orders.show',compact('record'));
    }
}
