<?php

namespace App\Http\Controllers\Admin\District;

use App\DataTables\districtsDataTable;
use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class districtController extends Controller
{
    //========================   validate  function
    private  function validatePost($request){
        $rules =[
            "name"=>"required",
            "city_id" => "required|exists:cities,id"
        ];
        $message = [
            "name.required" => "name must  have value",
        ];
        $this->validate($request,$rules,$message);
    }


    public function index(districtsDataTable $dataTable)
    {
        return $dataTable->render('admin.districts.index');

    }


    public function create()
    {
        return view("admin.districts.create");
    }


    public function store(Request $request)
    {
        $this->validatePost($request);
        District::create($request->all());
        alert()->success('success','district was create successfully ');
        return redirect('admin\district');
    }



    public function edit($id)
    {
        $record = District::findOrFail($id);
        return view('admin.districts.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $this->validatePost($request);
        $record = District::findOrFail($id);
        $record->update($request->all());
        alert()->success('success','district was updated successfully ');
        return redirect('admin\district');
    }


    public function destroy($id)
    {
        $record = District::findOrFail($id);
        try {
            $record->delete();
            alert()->success('success','district was deleted successfully ');

        }
        catch (\Exception $e){
            alert()->error('Error','can\'t delete this record ');

        }
        return redirect('admin\district');
    }
}
