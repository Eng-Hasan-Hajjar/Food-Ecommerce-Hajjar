<?php

namespace App\Http\Controllers\Admin\client;

use App\DataTables\clientsDataTable;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class clientController extends Controller
{
    //=======================   list&filter  delete  active & de-active ======================

    public  function  index(clientsDataTable $dataTable){
       return $dataTable->render('admin.clients.index');
    }



    //====================== active & de-active

    public  function status($id) {
        $record = Client::findOrFail($id);
        if($record){
            $s = $record->getAttribute('active');
            if($s == 0 )
                $record->active = 1;
            else
                $record->active = 0;
            $record->save();
            return redirect('admin/client');
        }
        else{
            return error_log("please try again");
        }
    }


    //================================== delete client
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        alert()->success('done' , 'client was deleted successfully ');
        return redirect('admin\client');
    }




}
