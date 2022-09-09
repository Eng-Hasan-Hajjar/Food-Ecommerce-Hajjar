<?php

namespace App\Http\Controllers\Front\Resturant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class productController extends Controller
{
    // validate products
    protected  function rulesProduct($request){
        $rules = [
            "name"=>"required|max:255",
            "description" =>"required|max:255",
            "price"=>"required",
            "duratrion"=>"required",
            "image" => "image|max:299|mimes:jpeg,jpg,png,gif",
        ];
        if (!($request->get('id'))) {
            $rules['image'] = 'required';
        }

        return $rules;
    }





    public function create()
    {
        return view('front.resturants.products.create');

    }


    public function store(Request $request)
    {
        $this->validate($request,$this->rulesProduct($request),[
            'max'=>'لابد من اختيار صوره لا تزيد عن 299 kB'
        ]);
        $filename = saveImage($request,'products');
        $product = $request->user()->products()->create($request->all());
        if($product){
            $product->image = $filename;
            $product->save();
            alert()->success('' , 'تم انشاء المنتج بنجاح');
            return redirect('resturant');
        }
        else{
            alert()->errors('خطاء','خطاء حاول  مره اخري');
            return back();
        }
    }



    public function edit($id)
    {
        $record = Product::findORFail($id);
        return view('front.resturants.products.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,$this->rulesProduct($request),[
            'max'=>'لابد من اختيار صوره لا تزيد عن 299 kB'
        ]);
        $record = Product::findOrFail($id);
        global  $filename;
        $filename= $record->image;
        if($request->hasFile('image')){
            if($record->image && file_exists('images/products/'.$record->image)){
                File::delete('images/products/'.$record->image);
                $filename = saveImage($request,'products');
            }
            else{
                $filename = saveImage($request,'products');
            }

        }

        $record->update($request->all());
        $record->image = $filename;
        $record->save();
        alert()->success('' , 'تم تعديل المنتج بنجاح');
        return redirect('resturant');

    }



    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        if($product){
            if($product->image && file_exists('images/'.$product->image)){
                File::delete('images/'.$product->image);
            }
            if($product->delete()){
                alert()->success('','تم حذف المنتج بنجاح');
                return back();
            }
            else{
                alert()->errors('خطاء','خطاء حاول  مره اخري');
                return back();
            }        }
    }


}
