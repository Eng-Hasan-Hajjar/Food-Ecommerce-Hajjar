<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function MongoDB\BSON\toJSON;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,ResturantAuth;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:resturant');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','unique:clients','max:255'],
            'phone' => ['required','max:14'],
            'category_list.*' => ['required','exists:categories,id'],
            'email' => ['required', 'string', 'email', 'unique:clients', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'district_id' => ['required', 'exists:districts,id'],
        ],[
            'required' => 'لابد من اكمال كافه البيانات المطللوبه',
            'confirmed'=>'كلمه السر غير متطابقه',
            'exists'=>'يجب ادخال قيم صحيحه',
            'email.unique'=>'الايميل موجود سابقا',
            'name.unique'=>'الاسم موجود سابقا برجاء كتابه اسم مختلف'
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' =>  Str::random(60),
            'phone' => $data['phone'],
            'image'=>'clientU.png',
            'district_id' =>$data['district_id']
        ]);
    }






}
