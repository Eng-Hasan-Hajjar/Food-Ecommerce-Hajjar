<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class settingController extends Controller
{
    //========================   validate  function
    private  function validateSetting($request){
        $rules =[
            "commission"=>"required|between:0.1,1|numeric",
            "about_app"=>"required",

        ];
        $message = [
            "phone_email.required" => "App email is required"
        ];

        $this->validate($request,$rules,$message);
    }



    public function index()
    {
        $record = Setting::first();
        return view('admin.Settings.setting',compact('record'));
    }

    public function update(Request $request, $id)
    {

        $this->validateSetting($request);
        $record = Setting::findOrFail($id);
        $record->update($request->all());
        return redirect('admin\setting')->with('status' , 'Setting was updated successfully :)');
    }


}
