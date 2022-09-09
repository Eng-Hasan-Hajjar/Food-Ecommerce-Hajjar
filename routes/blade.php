<?php

Blade::if('check' , function(){
    $auth =auth('resturant')->user();
    if($auth ==null ){
        return true;
    }
    else{
        return  false;
    }


});



?>
