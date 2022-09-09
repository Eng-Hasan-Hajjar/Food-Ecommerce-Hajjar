<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class mainController extends Controller
{
    //
    public function  contact(Request $request){
       $validate =  validator()->make($request->all(),[

            "full_name"=>"required",
            "email" =>"required|email",
            "phone"=>"required",
            "message"=>"required",
            "type" => "required|in:complaint,suggestion,inquiry",
        ]);
       if($validate->fails()){
           return responseJson(0,$validate->errors()->first(),$validate->errors());
       }
       $contact = Contact::create($request->all());
       return responseJson(1 ,'success' , $contact);
    }

    public  function about(){
        $about = settings()->getAttribute('about_app');
        return responseJson(1 , 'success',$about);
    }
}
