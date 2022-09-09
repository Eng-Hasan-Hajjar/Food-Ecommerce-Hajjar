<?php

namespace App\Http\Controllers\Admin\Offer;

use App\DataTables\offersDataTable;
use App\Models\Offer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class offerController extends Controller
{
       //=========================   show all message
    public  function  index(offersDataTable $dataTable){
        return $dataTable->render('admin.offers.index');
    }

    //================= delete message
    public function destroy($id)
    {
        $record = Offer::findOrFail($id);
        $record->delete();
        alert()->success('success' , 'offer was deleted successfully' );
        return back();
    }
}
