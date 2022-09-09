<?php

namespace App\Http\Controllers\Admin\resturant;

use App\DataTables\resturantsDataTable;
use App\Models\Resturant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class resturantController extends Controller
{
    //=======================   list&filter  delete  active & de-active ======================

    public  function  index(resturantsDataTable $dataTable){
        return $dataTable->render('admin.resturants.index');
//        $records = Resturant::paginate(10);
//        return view('admin.resturants.index',compact('records'));
    }

    //=======================   show resturant ======================

    public  function  show($id){
        $records = Resturant::find($id);
        return view('admin.resturants.index',compact('records'));
    }



    //====================== active & de-active

    public  function status($id) {
        $record = Resturant::findOrFail($id);
        if($record){
            $s = $record->getAttribute('active');
            if($s == 0 )
                $record->active = 1;
            else
                $record->active = 0;
            $record->save();
            return redirect('admin/resturant')->with('status' , 'resturant status was updated');
        }
        else{
            return error_log("please try again");
        }
    }

    //================================== delete resturant
    public function destroy($id)
    {
        $record = Resturant::findOrFail($id);
        $record->delete();
        alert()->success('success','resturant was deleted successfully');
        return redirect('admin\resturant');
    }




}
