<?php

namespace App\Http\Controllers\Front\Resturant;

use App\DataTables\employeesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function index(employeesDataTable $dataTable){
     return $dataTable->render('front.resturants.employees.index');
    }


    public function destroy($id){
        $employee = Employee::findOrFail($id);
         if($employee->delete()){
             alert()->success('تم','تم الحذف بنجاح');
         }else{
             alert()->error('خطاء','حدث خطاء حاول مره اخري');
         }
         return back();
    }
}
