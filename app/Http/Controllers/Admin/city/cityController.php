<?php

namespace App\Http\Controllers\Admin\city;

use App\DataTables\CitiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class cityController extends Controller
{
    //========================   validate  function
    public function index(citiesDataTable $dataTable)
    {
       return $dataTable->render('admin.cities.index');
    }

    public function create()
    {
        return view("admin.cities.create");
    }

    public function store(Request $request)
    {
        $this->validatePost($request);
        City::create($request->all());
        alert()->success('success', 'City was deleted successfully ');
        return redirect('admin/city');
    }

    private function validatePost($request)
    {
        $rules = [
            "name" => "required",
        ];
        $message = [
            "name.required" => "name must  have value",
        ];
        $this->validate($request, $rules, $message);
    }

    public function edit($id)
    {
        $record = City::findOrFail($id);
        return view('admin.cities.edit', compact('record'));
    }


    public function update(Request $request, $id)
    {
        $this->validatePost($request);
        $record = City::findOrFail($id);
        $record->update($request->all());
        alert()->success('success', 'City was updated successfully ');
        return redirect('admin\city');
    }


    public function destroy($id)
    {
        $record = City::findOrFail($id);
        try {
            $record->delete();
            alert()->success('success','district was deleted successfully ');

        }
        catch (\Exception $e){
            alert()->error('Error','can\'t delete this record ');

        }
        return redirect('admin\city');
    }
}
