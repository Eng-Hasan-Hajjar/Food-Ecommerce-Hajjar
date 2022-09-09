<?php

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class userController extends Controller
{
    //========================   validate  function
    private  function validateUSer($request){
        $rules =[
            "name"=>"required",
            "email" => "required|unique:users,email",
            "password"=>"required|confirmed",
            "roles_list" => "required"
        ];
        $message = [
            "name.required" => "name must  have value",
            "email.required" => "name must  have value",
            "password.required" => "password must  have value",
            "roles_list.required" => "roles   must  have value"

        ];
        $this->validate($request,$rules,$message);
    }



    public function index()
    {
        $records = User::paginate(10);
        return view('admin.users.index',compact('records'));
    }


    public function create()
    {
        return view("admin.users.create");
    }


    public function store(Request $request)
    {
        $this->validateUSer($request);


        $request->merge(["password" => bcrypt($request->password)]); // hash password
        $user = User::create($request->except('roles_list'));

        $user->assignRole($request->roles_list);
        return redirect('admin\user')->with('status' , 'Admin was create successfully :)');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $record = User::findOrFail($id);
        return view('admin.users.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $validate = $this->validate($request,[
            "name"=>"required",
            "email" => "required",
            "roles_list" => "required"
        ]);
        $user = User::findOrFail($id);
        $user->syncRoles($request->roles_list);
        $user->update($request->all());
        return redirect('admin\user')->with('status' , 'User was updated successfully :)');
    }


    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        return redirect('admin\user')->with('status' , 'User was deleted successfully :)');
    }
}
