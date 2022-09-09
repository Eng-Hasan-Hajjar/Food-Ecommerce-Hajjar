<?php

namespace App\Http\Controllers\Front\Resturant;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class offerController extends Controller
{
    // validate offers
    protected  function rulesOffer($request){
        $rules = [

            "name"=>"required",
            "description" =>"required",
            "from"=>"required",
            "to"=>"required",
            "image" => "image|max:299|mimes:jpeg,jpg,png,gif",
        ];
        if (!($request->get('id'))) {
            $rules['image'] = 'required';
        }

        return $rules;
    }

      public function index(){
          $offers = Offer::whereHas('resturant' , function ($query){
              $query->where('resturants.id',Auth::id());
          })->paginate(8);
          return view('front.resturants.offers.index',compact('offers'));
      }



    public function create()
    {
        return view('front.resturants.offers.create');

    }


    public function store(Request $request)
    {
        $this->validate($request,$this->rulesOffer($request),[
            'max'=>'لابد من اختيار صوره لا تزيد عن 299 kB',
            '*.required'=>'لابد من  اكمال كافه البيانات الفارغه'
        ]);
        $filename = saveImage($request,'offers');
        $offer = $request->user()->offers()->create($request->all());
        if($offer){
            $offer->image = $filename;
            $offer->save();
            alert()->success('' , 'تم انشاء العرض بنجاح');
            return redirect('resturant/offer');
        }
        else{
            alert()->errors('خطاء','خطاء حاول  مره اخري');
            return back();
        }
    }



    public function edit($id)
    {
        $record = Offer::findORFail($id);
        return view('front.resturants.offers.edit',compact('record'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,$this->rulesOffer($request),[
            'max'=>'لابد من اختيار صوره لا تزيد عن 299 kB',
            '*.required'=>'لابد من  اكمال كافه البيانات الفارغه'

        ]);
        $record = Offer::findOrFail($id);
        global  $filename;
        $filename= $record->image;
        if($request->hasFile('image')){
            if($record->image && file_exists('images/offers/'.$record->image)){
                File::delete('images/offers/'.$record->image);
                $filename = saveImage($request,'offers');
            }
            else{
                $filename = saveImage($request,'offers');
            }

        }

        $record->update($request->all());
        $record->image = $filename;
        $record->save();
        alert()->success('' , 'تم تعديل االعرض بنجاح');
        return redirect('resturant/offer');

    }



    public function destroy($id)
    {
        //
        $offer = Offer::findOrfail($id);
        if($offer){
            if($offer->image && file_exists('images/'.$offer->image)){
                File::delete('images/'.$offer->image);
            }
            if($offer->delete()){
                alert()->success('','تم حذف العرض بنجاح');
                return back();
            }
            else{
                alert()->errors('خطاء','خطاء حاول  مره اخري');
                return back();
            }        }
    }


}
