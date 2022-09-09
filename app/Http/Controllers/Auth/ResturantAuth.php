<?php

namespace App\Http\Controllers\Auth;

use App\Models\Resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Redirect;

trait ResturantAuth
{

    /*validate for resturant */
    public function showRegister()
    {
        return view('front.resturants.register');
    }

    public function createResturant(Request $request)
    {
        $this->resturantValidator($request);
        $request->merge(["password" => Hash::make($request->password)]); // hash password
        $filename = saveImage($request, 'profile');
        $resturant = Resturant::create($request->all());
        $resturant->categories()->sync($request->category_list);
        $id = $resturant->id;
        $resturant->image = $filename;
        $resturant->api_token = Str::random(60);                 // added random token
        $resturant->save();
        Auth::guard('resturant')->loginUsingId($id);
        return $this->registered($request, $resturant)
            ?: redirect()->intended('/resturant');
    }

    /* create resturant */

    protected function resturantValidator($data, $id = null)
    {
        $rules = [
            'name' => ['required', 'string', 'unique:resturants', 'max:255'],
            'minimum_order' => ['required'],
            'delivery_charge' => ['required'],
            'contact_phone' => ['required'],
            'category_list.*' => ['required', 'exists:categories,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:resturants'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'district_id' => ['required', 'exists:districts,id'],
            'state' => ['in:0,1'],
            'job' => ['in:0,1'],
        ];
        $message = [
            'required' => 'لابد من اكمال كافه البيانات المطللوبه',
            'confirmed' => 'كلمه السر غير متطابقه',
            'exists' => 'يجب ادخال قيم صحيحه',
            'email.unique' => 'الايميل موجود سابقا',
            'name.unique' => 'الاسم موجود سابقا برجاء كتابه اسم مختلف',
            '*.in' => 'برجاء اختيار قيمه صحيحه'
        ];
        $this->validate($data, $rules, $message);
    }

    public function showLogin()
    {
        return view('front.resturants.login');
    }

    public function loginResturant(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => 'اكمل كافه البيانات المطلوبه',
            'email' => 'برجاء ادخال قيم صحيحه'
        ]);
        if (Auth::guard('resturant')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/resturant');
        }
        $errors = new MessageBag(['password' => ['الايميل او الباسورد غير صحيح']]);
        return Redirect::back()->withErrors($errors)->withInput($request->only('email', 'remember'));
    }


}
