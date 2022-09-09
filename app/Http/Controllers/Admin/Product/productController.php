<?php

namespace App\Http\Controllers\Admin\Product;

use App\DataTables\productsDataTable;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productController extends Controller
{
       //=========================   show all product
    public  function  index(productsDataTable $dataTable){
        return $dataTable->render('admin.products.index');
    }



    //================= show product
    //================= delete message
    public function destroy($id)
    {
        $record = Product::findOrFail($id);
        $record->delete();
        alert()->success('success' , 'Product was deleted successfully' );
        return back();
    }
}
