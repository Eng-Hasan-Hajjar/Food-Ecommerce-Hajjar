<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class authcontroller extends Controller
{

    //validate
    // validate products
    protected  function validateClient($request){
        return validator()->make($request->all(),[
            "phone"=>"required",
            "name" =>"required",
            "email"=>"required|unique:resturants",
            "password"=>"required|confirmed",
            "district_id"=>"required|exists:districts,id",
            "image" => "required"
        ]);


    }
    //============== start
    //========================== register client
    public function register(Request $request){

        if($v=$this->validateClient($request)->fails()){
            return responseJson(0,$v->errors()->first(),$v->errors());
        }
        $request->merge(["password" => bcrypt($request->password)]); // hash password
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);                 // added random token
        $client->save();
        return responseJson(1,[
            "resturant" => $client,
            "api_token"=>$client->api_token
        ],"تم الاضافه بنجاح");

    }


    //============================== login client
    public function login(Request $request)
    {
        $validate = validator()->make($request->all(),[

            "email"=>"required",
            "password"=>"required"

        ]);
        if($validate->fails()){
            return responseJson(0,$validate->errors()->first(),$validate->errors());
        }

        //return auth()->guard('api')->validate($request->all());

        $client = Client::where('email',$request->email)->first();
        if($client){

            if(\Hash::check($request->password,$client->password)){
                return responseJson("1",[
                    "api_token"=>$client->api_token,
                    "client"=>$client
                ],"تم تسجيل الدخول");
            }
            else{
                return responseJson(0,'بيانات الدخول  غير صحيحه');
            }

        }
        else{
            return responseJson(0,'بيانات الدخول  غير صحيحه');
        }

    }


    // php artisan make:mail ResetPassword -markdown=emails.auth.rest
    //============================== resetPassword  service
    public function resetPassword(Request $request)
    {
        $validate = validator()->make($request->all(), [
            "email" => "required",
        ]);

        if ($validate->fails()) {
            return responseJson(0, $validate->errors()->first(), $validate->errors());
        }

        $client = Client::where("email", $request->email)->first();
        if ($client) {
            $pincode = rand(1111, 9999);
            $update = $client->update(['pin_code' => $pincode]);
            if ($update) {
                Mail::to($client->email)
                    ->bcc("kerolesatef200@gmail.com")
                    ->send(new ResetPassword($pincode));

                return responseJson(1, "برجاء فحص الميل ", [
                    "pin code for your account is :" => $client->pin_code,
                    "mail_fails" => Mail::failures()
                ]);
            } else {
                return responseJson(0, "حدث خطاء حاول  مره اخري ");
            }
        } else {
            return responseJson(0, "لا يوجد حساب مرتبط بهذا الميل ");
        }
    }
    //=======================save new password

    public function password(Request $request){
        $validate = validator()->make($request->all(), [
            "pin_code"=>"required",
            "email" => "required",
            "password" =>"required|confirmed"
        ]);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors()->first(), $validate->errors());
        }
        $client = Client::where("pin_code",$request->pin_code)->where("pin_code","!=",0)
            ->where("email",$request->email)->first();
        if($client){
            
            $client->password = bcrypt($request->password);
            $client->pin_code = null;

            if($client->save()){
                return responseJson(1 , "تم تغير الرقم السري بنجاح  ");

            }
            else{
                return responseJson(0 , "حدث خطاء حاول مره اخري");

            }
        }
        else{

            return responseJson(0 , "هذا الكود غير صحيح ");
        }

    }

    //==================================================================================
    //============================= get profile  service
    public  function  profile(Request $request){
        $id = auth('api_client')->user()->id;
        $client = Client::find($id);
        return responseJson(1,'معلومات الحساب ',$client);

    }
    //============================= update profile  service

    public  function  updateProfile(Request $request){
        $id = auth('api_client')->user()->id;
        $client = Client::find($id);
        if($client){
            if($v=$this->validateClient($request)->fails()){
                return responseJson(0,$v->errors()->first(),$v->errors());
            }
            $request->merge(["password" => bcrypt($request->password)]); // hash password
            $client->update($request->all());
            return responseJson(1,'معلومات الحساب ',$client);
        }
        else{
            return responseJson(0,'no resturant  ');
        }


    }


    //========================================   register  token
    public function registerToken(Request $request){

        $validate = validator()->make($request->all(),[

            "token"=>"required"
        ]);
        if($validate->fails()){
            return responseJson(0,$validate->errors()->first(),$validate->errors());
        }

        Token::where("token",$request->token)->delete();
        $request->user('api_resturant')->tokens()->create($request->all());
        return responseJson(1,"تم التسجيل بنجاح");
    }

    //==========================================   remove   token
    public function removeToken(Request $request){

        $validate = validator()->make($request->all(),[
            "token"=>"required",
        ]);
        if($validate->fails()){
            return responseJson(0,$validate->errors()->first(),$validate->errors());
        }
        Token::where("token",$request->token)->delete();
        return responseJson(1,"تم الحذف  بنجاح");
    }
}
