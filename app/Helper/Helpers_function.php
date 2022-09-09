<?php


// return settings  model
function settings(){
    $settings = \App\Models\Setting::find(1);
    if($settings){
        return $settings;
    }
    else{
        return new \App\Models\Setting;
    }
}









// static response

function responseJson($status , $msg , $data=null){

    $Response = [

        "status" =>$status ,
        "message" =>$msg,
        "data"   =>$data
    ];

    return response()->json($Response);
    }

    //  function to push notification by firebase

    function notifyByFirebase($title,$body,$tokens,$data = [] , $is_notification = true)        // paramete 5 =>>>> $type
    {
    $registrationIDs = $tokens;
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'data' => $data
    );
    if($is_notification){
        $fcmFields['notification'] = $fcmMsg;
    }
    //dd(env('FIREBASE_API_ACCESS_KEY'));
    $headers = array(
        'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


//======================  active satus
// return active and btn-success if 0   &&  return de-active btn-danger  if 1

function activeStatus($status){
    $activeState = [];
    if($status != 0) {
        $activeState = ["btn-danger","de-active"];
    }
    else{
        $activeState = ["btn-success","active"];

    }
    return $activeState;
}


//========================================  save image
//=============================
    function saveImage($request,$folder) {
    if($request->hasfile('image'))
    {
        $file =$request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = 'user_image'.time().'.'.$ext;
        Image::make($file)->save(public_path('images/'.$folder.'/'.$filename));
    }
    else{
        $filename = '';
    }
    return $filename;
    }



    //======================================  notify
  function notify($table,$content,$order_id,$title,$type){
    /* notifications  */
    // create notification in database
    $table->notifications()->create([
        'content' => $content,
        'order_id' => $order_id
    ]);
    $tokens = $table->tokens()->where('token','!=','')->pluck('token')->toArray();
    $data = [
        'user_type' => $type,
        'action' => $title,
        'order_id' => $order_id
    ];
    info(json_encode($data));
    if(count($tokens)) {
        $send = notifyByFirebase($title, $content, $tokens, $data);
        info("firbase result " .$send);
    }
    return responseJson(1 , "success");
    /* end notifications  */
}






/* notifications  */
// create notification in database
/*
$resturant->notifications()->create([
    'content' => 'you have new order from user '.$request->user()->name,
    'order_id' => $order->id
]);
$tokens = $resturant->tokens()->where('token','!=','')->pluck('token')->toArray();
$body =
$data = [
    'user_type' => 'resturant',
    'action' => 'new-order',
    'order_id' => $order->id
];
info(json_encode($data));
if(count($tokens)) {
    $send = notifyByFirebase("new order ", $resturant->content, $tokens, $data);
    info("firbase result " .$send);
}
return responseJson(1 , "success" , $order);
*/
/* end notifications  */



