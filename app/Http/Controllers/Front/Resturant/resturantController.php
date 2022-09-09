<?php

namespace App\Http\Controllers\front\Resturant;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditResturant;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class resturantController extends Controller
{

    //======================= index
    public function index()
    {
        $restaurant = auth()->user();
        $products = $restaurant->products()->paginate(12);
        return view('front.resturants.index', compact(['restaurant', 'products']));
    }

    /* commission */
    public function commission()
    {

        $sales = Order::where('resturant_id', Auth::id())->where('state', 'delivered')
            ->sum('total');
        $commission = $sales / settings()->getAttribute('commission') / 100;
        $paid = Payment::where('resturant_id', Auth::id())
            ->sum('paid');
        $data = [
            'text1' => settings()->getAttribute('tex_up'),
            'sales' => $sales,
            'commission' => $commission,
            'paid' => $paid,
            'rest' => $commission - $paid,
            'acc1' => settings()->getAttribute('acc1'),
            'acc2' => settings()->getAttribute('acc2'),
            'text2' => settings()->getAttribute('text_down'),

        ];
        return view('front.resturants.commission', compact('data'));


    }


    #Edit Profile
    public function edit()
    {
        $record = auth()->user();
        return view('front.resturants.profile', compact('record'));
    }

    #Save Edited Profile
    public function update(EditResturant $request)
    {
        $validated = $request->validated();
        global $filename;
        $user = auth()->user();
        $filename = $user->image;
        if ($request->hasFile('image')) {
            if ($user->image && file_exists('images/profile/' . $user->image)) {
                File::delete('images/profile/' . $user->image);
                $filename = saveImage($request, 'profile');
            } else {
                $filename = saveImage($request, 'profile');
            }
        }
        try{

            $user->update($validated);
            $user->categories()->sync($validated['category_list']);
            $user->image = $filename;
            $user->save();
            alert()->success('', 'تم تعديل البيانات بنجاح');
            return redirect()->back();
        }
        catch (\Exception $e){
            alert()->error('خطاء', 'برجاء اكمال كافه  البيانات');
            return redirect()->back();
        }



    }


    // list notifications
    public function notification()
    {
        $notification = auth('api_resturant')->user()->notifications()->get();
        return responseJson(1, "success", $notification);
    }


}
