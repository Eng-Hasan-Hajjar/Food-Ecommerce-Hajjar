<?php

namespace App\Http\Controllers\Front\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployee;
use App\Models\Employee;
use App\Models\Resturant;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function index()
    {
        $resturants = Resturant::where('job', '1')->where('active', '1')->paginate(50);
        return view('front.clients.job', compact('resturants'));
    }

    public function apply($id)
    {
        $resturant = Resturant::findOrFail($id);
        return view('front.clients.apply', compact('resturant'));
    }

    public function storeApply(StoreEmployee $request)
    {
        $request->validated();
        $resturant = Resturant::findOrFail($request->resturant_id);
        if ($resturant->job != 1) {
            alert()->error('خطاء', 'هذا المطعم لايقبل عمال ف الوقت الحالي الرجاء اختيار مطعم اخر من القائمه الرئيسية');
            return back();
        }
        if (Employee::create($request->all())) {
            alert()->success('تم', 'تم التقدم الي الوظية  وسيتم الاتصال بك من قبل المطعم اذا قام باختيارك');
            return redirect('job');
        }
        alert()->error('خطاء', 'حدث خطاء حاول مره اخري');
        return back();
    }

    // search for resturant (ajax)
    public function jobSearch(Request $request)
    {

        $resturants = Resturant::wherehas('district.city', function ($query) use ($request) {
            if (!empty(intval($request->city))) {
                $query->where("cities.id", $request->city);
            }
        })->where(function ($query) use ($request) {
            if (!empty(strval($request->resturant))) {
                $query->where('name', 'like', '%' . $request->resturant . '%');
            }
        })->where(['active' => '1', 'job' => '1'])->get();
        $result = '';
        if (count($resturants)) {
            foreach ($resturants as $resturant) {
                $result .= ' <div class="col-4">
                                            <div class="card">
                                                <img src="' . url("images/profile/$resturant->image") . '"
                                                     class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">
                                                        <a href="' . url("resturants/.$resturant->id") . '"
                                                           class="text-danger"
                                                           style="text-decoration: none">' . $resturant->name . '</a>
                                                        <p class="float-left">';
                for ($i = 1; $i <= 5; $i++) {
                        $result.='<span>';
                     if($resturant->review >=$i){
                         $result.='<i class=" fas fa-star"></i>';
                     }else{
                         $result.='<i class=" far fa-star"></i>';
                     }
                    $result.='</span>';
                }

                $result .= '                      </p>
                                                    </h5>
                                                    <p class="card-text text-info">
                                                    <i class="fas fa-map-marker-alt"></i>' . $resturant->district->city->name . '-' . $resturant->district->name . '</p>
                                                    <a href="' . url("apply/$resturant->id") . '" class="btn btn-primary">تقدم علي الوظيفة</a>
                                                </div>
                                            </div>
                                        </div>';
            }
        } else {
            $result .= '<div class="col text-muted text-center py-5">
                                    <span>لا يوجد مطاعم مطابقه لبحثك </span>
                                </div>';

        }
        return $result;
    }

}
