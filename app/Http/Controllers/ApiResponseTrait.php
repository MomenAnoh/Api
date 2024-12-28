<?php

namespace App\Http\Controllers;

trait ApiResponseTrait
{
    // دلوقتي هعمل الفانكشن واديها براميتر واعملها مثلا قيمة ديفلت نلل واعمل هنا الشغل الي كان هناك
   public function apiResponse($data= null,$message = null,$status = null){

       $array = [
           'data'=>$data,
           'message'=>$message,
           'status'=>$status,
       ];

       return response($array);

   }
}