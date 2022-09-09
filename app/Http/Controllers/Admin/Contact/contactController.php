<?php

namespace App\Http\Controllers\Admin\Contact;

use App\DataTables\contactsDataTable;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class contactController extends Controller
{
       //=========================   show all message
    public  function  index(contactsDataTable $dataTable){
        return $dataTable->render('admin.contacts.index');
    }



    //================= delete message
    public function destroy($id)
    {
        $record = Contact::findOrFail($id);
        $record->delete();
        alert()->success('success' , 'client was deleted successfully' );
        return redirect('admin\contact');
    }
}
