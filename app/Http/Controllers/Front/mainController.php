<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderBroduct;
use App\Models\Resturant;
use Illuminate\Http\Request;
use function foo\func;

class mainController extends Controller
{

    public function __construct(){
        $this->middleware('check')->only('index');

    }

    //   route get ( / )

    public function index()
    {
        $resturants = Resturant::where('state', 1)->where('active', '1')->paginate(20);
        return view('front.home', compact('resturants'));
    }

    // show contact form
    public function contact(){
        return view('front.contact');
    }

     // contact with us
    public function sendMessage(Request $request){

        $rules = [
            'full_name'=>'required|max:255',
            'email'=>'required|email',
            'phone'=>'required|max:14',
            'message'=>'required|max:255',
            'type'=>'required|in:complaint,suggestion,inquiry'
        ];
        $this->validate($request,$rules);
       $message =  Contact::create($request->all());
       if($message){
           alert()->success('','تم ارسال الرساله سوف يتم مراجعتها من قبل الاداره شكرا لتعاونك معنا ');
       }else{
           alert()->error('خطاء','حدث خطاء حاول  مره اخري ');
       }
         return redirect('contact-us');
    }

     // search for resturant (ajax)
    public function resturantSearch(Request $request){
        $resturants = Resturant::wherehas('district.city',function ($query) use ($request){
            if(!empty(intval($request->city)))
            {
                $query->where("cities.id",$request->city);
            }})->where(function ($query) use ($request) {
            if(!empty(strval($request->resturant))){
                $query->where('name', 'like', '%' .$request->resturant. '%');
            }
        })->where(['active'=>'1','state'=>'1'])->get();
            $result = '';
        if(count($resturants)){
            foreach ($resturants as $resturant) {
                $result .= '<div class="col-md-6 col-12 ">
                        <div class="back-color">
                            <div class="row">
                                <div class="col-sm-5 col-12">';
                if ($resturant->image)
                    $result .='<img class="w-100" style="border-radius:50% "src="'.asset('images/profile/'.$resturant->image).'">';
                $result .= '</div>
                                <div class="col-sm-5 col-lg-5 col-md-7 col-12">
                                    <a href="'.url("resturants").'/'.$resturant->id.'" style="color: #ec3454;font-size: 38px;
                                        text-decoration-line: none;
                                        ">'.$resturant->name.'</a>
                                    <div class="star" >
                                        <ul class="list-unstyled">';
                                            for($i=0;$i<$resturant->review;$i++) {
                                               $result.='<li><span ><i class="fas  fa-star  " ></i ></span ></li >';
                                                }
                                                for($i=0;$i<5-$resturant->review;$i++) {
                                                 $result.='<li><span ><i class="fas  fa-star active " ></i ></span ></li >';
                                               }
                                                $result.='
                                        </ul>
                                    </div>
                                    <p>الحد الادني للطلب:<span>'.$resturant->minimum_order.'ريال</span></p>
                                    <p>رسوم التوصيل :<span>'.$resturant->delivery_charge.'ريال</span></p
                                </div>
                                </div>
                                <div class=" col-lg-2 col-md-12 col-sm-2 col-12 text-center pr-0  mt-lg-4 mt-0  ">
                                    <div class="test mt-sm-5 mt-lg-5 mt-md-0 mt-0">
                                    <span class="span-color"></span>
                                    <span class="span-test">مفتوح</span> </div>
                                </div>
                            </div>
                        </div> </div>
                    </div>';
            }
            }
        else{
                 $result .='  <!-- start card -->
                    <section class="cart-parend cart-current footer-bottom">
                        <div class="container">
                            <div class="container-local">
                                <div class=" cart">
                                    <div class="row">
                                        <div class="col col-sm-7 col-12">
                                            <h3 class="text-left py-3 text-info"> لا يوجد مطاعم مطابقه لهذا البحث </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- end card -->';

        }
        return $result;
    }


    // load district by city
    public function loadDistrict(){
        $city_id = $_GET['city_id'];
        $district = District::whereHas('city',function ($querey) use ($city_id){
            $querey->where('cities.id',$city_id);
        })->get();
        if(count($district) > 0){
            return responseJson("1",'success',$district);
        }

    }



    /* show details for order */
    public function details()
    {
        $id = $_POST['id'];
        $order = Order::findOrFail($id);
        $details = '
   <section class="twe-order-info footer-bottom">
    <div class="container">
        <h2 class="text-right m-2"> تفاصيل الطلب</h2>
        <div class="name-res text-right d-flex flex-row" style="background: #ececec">
            <div >
                <img class="h-100 rounded-circle"  src="' . asset('images/profile/' . $order->resturant->image) . '">
            </div>
            <div >
                <h3 >كنتاكي </h3>
                <p>:  يوم <span>' . $order->created_at . '</span></p>
            </div>
        </div>
        <div class="adderrs d-flex" style="background: #ececec">
            <h4 > العنوان :</h4>
            <p>' . $order->address . ', ' . $order->client->district->name . ', ' . $order->client->district->city->name . '</p>
        </div>
        <div class="row meal-info text-right" style="background: #ececec">
            <div  class="col-12">
                <h3 >تفاصيل الطلب</h3>
            </div >
            ';
        foreach (OrderBroduct::where('order_id', $id)->get() as $i) {
            $details .= '
                 <div class="col-12">
                  <div class="row">
                 <div class="col-3">
                               <p>' . $i->product . '</p>
                             </div>
            <div class="col-6">
                <p>' . $i->price . ' ريال</p>
            </div></div></div>';
        }
        $details .= '
        </div>
        <div class="total text-right" style="background: #ececec">
            <p>سعر الطلب :<span class="text-center">' . $order->cost . '</span></p>
            <p>رسم التوصيل :<span>' . $order->delivery_cost . ' ريال</span></p>
            <p> الاجمالي   :<span>' . $order->total . ' ريال</span></p>
            <p> الدفع   :<span>كاش </span></p>

        </div>
    </div>
</section>
             ';

        return $details;
    }


}
