<?php

namespace App\Http\Controllers\Admin\category;

use App\DataTables\categoriesDataTable;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    //========================   validate  function
    private  function validateCategory($request){
        $rules =[
            "name"=>"required",
        ];
        $message = [
            "name.required" => "name must  have value",
        ];
        $this->validate($request,$rules,$message);
    }



    public function index(categoriesDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }


    public function create()
    {
        return view("admin.categories.create");
    }


    public function store(Request $request)
    {
        $this->validateCategory($request);
        Category::create($request->all());
        alert()->success('success', 'category was created successfully ');
        return redirect('admin/category');
    }





    public function edit($id)
    {
        $record = Category::findOrFail($id);
        return view('admin.categories.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $this->validateCategory($request);
        $record = Category::findOrFail($id);
        $record->update($request->all());
        alert()->success('success', 'Category was updated successfully ');
        return redirect('admin/category');
    }


    public function destroy($id)
    {
        $record = Category::findOrFail($id);
        $record->delete();
        alert()->success('success','Category was deleted successfully ');
        return redirect('admin/category');
    }
}
