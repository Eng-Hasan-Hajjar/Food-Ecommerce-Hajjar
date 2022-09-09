<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Resturant;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class authController extends Controller
{
    //validate
    protected  function validateResturant($request){
        $validate = validator()->make($request->all(),[
            "phone"=>"required",
            "name" =>"required",
            "email"=>"required|unique:resturants",
            "password"=>"required|confirmed",
            "district_id"=>"required|exists:districts,id",
            'delivery_charge' => 'required',
            'minimum_order' => 'required',
            'contact_phone'=>'required',
            'categories.*' => 'required|exists:categories,id',
        ]);
        return $validate;

    }
    //============== start
    //========================== register resturant
    public function register(Request $request){
         $validate = $this->validateResturant($request);
        if($validate->fails()){
            return responseJson(0,$validate->errors()->first(),$validate->errors());
        }
        $request->merge(["password" => bcrypt($request->password)]); // hash password
        $resturant = Resturant::create($request->except('categories'));
        $resturant->api_token = Str::random(60);                 // added random token
        $resturant->save();
        $resturant->categories()->sync($request->categories);
        return responseJson(1,[
            "resturant" => $resturant,
            "api_token"=>$resturant->api_token
        ],"تم الاضافه بنجاح");

    }


    //============================== login resturant
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

        $resturant = Resturant::where('email',$request->email)->first();
        if($resturant){

            if(\Hash::check($request->password,$resturant->password)){
                return responseJson("1",[
                    "api_token"=>$resturant->api_token,
                    "client"=>$resturant
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

        $resturant = Resturant::where("email", $request->email)->first();
        if ($resturant) {
            $pincode = rand(1111, 9999);
            $update = $resturant->update(['pin_code' => $pincode]);
            if ($update) {
                Mail::to($resturant->email)
                    ->bcc("kerolesatef200@gmail.com")
                    ->send(new ResetPassword($pincode));

                return responseJson(1, "برجاء فحص الميل ", [
                    "pin code for your account is :" => $resturant->pin_code,
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
        $resturant = Resturant::where("pin_code",$request->pin_code)->where("pin_code","!=",0)
            ->where("email",$request->email)->first();
        if($resturant){

            $resturant->password = bcrypt($request->password);
            $resturant->pin_code = null;

            if($resturant->save()){
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
        $id = auth('api_resturant')->user()->id;
        $resturant = Resturant::find($id);
        return responseJson(1,'معلومات الحساب ',$resturant);

    }
    public  function  updateProfile(Request $request){
        $id = auth('api_resturant')->user()->id;
        $resturant = Resturant::find($id);
        if($resturant){
            if($v=$this->validateResturant($request)->fails()){
                return responseJson(0,$v->errors()->first(),$v->errors());
            }
            $request->merge(["password" => bcrypt($request->password)]); // hash password
            $resturant->update($request->all());
            return responseJson(1,'معلومات الحساب ',$resturant);
        }
        else{
            return responseJson(0,'no resturant  ');
        }


    }


    //========================================   register  token
    public function registerToken(Request $request){

        $validate = validator()->make($request->all(),[

            "token"=>"required",
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
