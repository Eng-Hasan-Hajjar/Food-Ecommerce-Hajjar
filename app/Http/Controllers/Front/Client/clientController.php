<?php

namespace App\Http\Controllers\Front\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditClient;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class clientController extends Controller
{
    /* one resturant  */
    public function resturant($id)
    {
        $resturant = Resturant::findOrFail($id);
        return view('front.clients.resturant', compact('resturant'));
    }

    /* one product  */
    public function product($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::where('resturant_id', $product->resturant->id)->get();
        return view('front.clients.product', compact('product', 'products'));
    }

    /* show info about any resturant  */
    public function info($id)
    {
        $resturant = Resturant::findOrFail($id);
        return view('front.clients.resturantInfo', compact('resturant'));
    }

    /* review and comment  */
    public function review(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'reate' => 'required|in:1,2,3,4,5',
            'comment' => 'required|max:255',
            "resturant_id" => "required|exists:resturants,id"
        ], [
        'reate.required' => 'اضغط علي النجوم اولا  للتقيم',
        'reate.in' => 'اختر قيم صحيحه',
        'comment.required' => 'اكتب تعليقا قبل  الارسال ',

    ]);

        if ($validator->fails()) {
            alert()->error('خطاء', $validator->messages()->all());
            return back();
        }
            $request->user()->reviews()->create($request->all());
        alert()->success('تم', 'تم  نشر  تعليقك  بنجاح');
        return back();
    }

    /* list offers  */
    public function offer()
    {
        $offers = Offer::paginate(20);
        return view('front.clients.offer', compact('offers'));
    }

    /* search for  product  */
    public function searchProduct(Request $request)
    {

        $this->validate($request, [
            'product' => 'required|max:255'
        ]);
        $products = Product::where('name', 'like', '%' . $request->product . '%')->paginate(20);
        return view('front.clients.products', compact('products'));

    }

    #Edit Profile
    public function edit()
    {
        $record = auth()->user();
        return view('front.clients.profile', compact('record'));
    }

    #Save Edited Profile
    public function update(EditClient $request)
    {
        $validated = $request->validated();
        global $filename;
        $user = auth()->user();
        $filename = $user->image;
        if ($request->hasFile('image') &&  $validated['image']->getClientOriginalName() !='clientU.png') {
            if ($filename && file_exists('images/profile/' . $filename)) {
                File::delete('images/profile/' . $filename);
                $filename = saveImage($request, 'profile');
            } else {
                $filename = saveImage($request, 'profile');
            }
        }
        $user->update($validated);
        $user->image = $filename;
        $user->save();
        alert()->success('', 'تم تعديل البيانات بنجاح');
        return redirect()->back();


    }
}

