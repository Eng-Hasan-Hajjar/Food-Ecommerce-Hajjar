<?php

namespace App\Http\Controllers\Admin\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class roleController extends Controller
{
    //========================   validate  function
    private  function validateRole($request){
        $rules =[
            "name"=>"required|unique:roles,name",
            "permissions_list" => "required|array",

        ];
        $message = [
            "name.required" => "name must  have value",
            "permissions_list.required" => "permissions list must have value",


        ];
        $this->validate($request,$rules,$message);
    }



    public function index()
    {
        $records = Role::paginate(10);
        return view('admin.roles.index',compact('records'));
    }


    public function create()
    {
        return view("admin.roles.create");
    }


    public function store(Request $request)
    {

        $this->validateRole($request);

        $role = Role::create(['name'=>$request->name,'description'=>$request->description]);
        $role->permissions()->sync($request->permissions_list);
        return redirect('admin/role')->with('status' , 'Role was create successfully :)');
    }





    public function edit($id)
    {
        $record = Role::findOrFail($id);
        return view('admin.roles.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $rules =[
            "name"=>"required|unique:roles,name,".$id,
            "permissions_list" => "required|array",

        ];
        $message = [
            "name.required" => "name must  have value",
            "permissions_list.required" => "permissions list must have value",
        ];
        $this->validate($request,$rules,$message);
        $record = Role::findOrFail($id);
        $record->update($request->except(['permissions_list']));
        $record->permissions()->sync($request->permissions_list);

        return redirect('admin\role')->with('status' , 'Role was updated successfully :)');
    }


    public function destroy($id)
    {
        $record = Role::findOrFail($id);
        $record->delete();

        return redirect('admin\role')->with('status' , 'Role was deleted successfully :)');
    }
}
