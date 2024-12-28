<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\Post_Resource;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $showposts=Post::get();
       // $showposts=Post_Resource::collection(Post::get());دي لو عاوز بيانات معينة شارحها تحت
        // return view............        كدا  api  هنا مفيش كدا مفيش ف ال 
        
        // response(الكونتنت الي هيعرض البيانات , status دي بتدل ع الجحلة ديفلت 200 يعني عملية ناجحة الخ بقا ,  array احط فيها الرسالة الي عاوز اقولها او الي عاوز اوصلها للفرونت او الموبيال   );              الدبد بقا ريسبونس السنتكس بقا 
    //    return response($showposts,200,['ok']);       دا الشكل السنتكس الشكل المعروف ومتداول هعملة تحت حالا 
    
    // $array=[
        //   'data'=>$showposts, // ممكن بدل داتا تكون كي او فاليو حسب متتفق مع الفرونت او الموبايل 
        //   'msg'=>'ok',
        //   'status'=>200
        // ];
        // return response($array); 
        //الي عدي دا شكل مبتدئين دلوقتي انا هستخدم شكل الريسبونس في كل الي اي بي اي يبقا الافضل استخدم تريت اعمل تريد اسمة اي حاجة واحط فية الفانكشن واعملة يوز هنا 
        
        //$this  هعمل الريسبونس واديلو البيانات الي هتخش ف التريت هناك كبراميتر يعني واستخدم الفانكشن الي هناك هنا  بس قبلها 
        // return $this->apiResponse(content,msg,state); الماسدج والاستيس اتبدلو والماسدجج احطها هنا من غير اقواس اراي 
        return $this->apiResponse($showposts,'ok',200);
        
    }
        // او عاوز ارجع بوست واحد بس مثلا 

        // public function show($id)
        // {
        //   $showone=Post::find($id);
        //   if($showone)
        //   {
            
        //       return $this->apiResponse($showone,'ok',200);
        //   }
        //   else{
            //     return $this->apiResponse('NULL','This post not found',401);
            //   }
            // } 
            
            // الي فات دا بيجيب كل البيانات دلوقتي مثلا عاوز ارجع بينات معينة بس الاي دي بس مثلا او التايتل والاي دي بس التايتل بس الخ هعمل حاجة اسمها ريسورس واحدد فيها يرجعلي اي 
            public function show($id)
            {
                //syntax
                // $showone=new Post_Resource(Post::find($id));// بس في الحالة دي مش هيشغعلب الاف يعني لو صح هيطبع لو غلط هيييجيب ايرررور  ف الصح اعمل الخطوة دي ف الاقواس مكان براميتر الداتا
                $showone=Post::find($id); 
                if($showone)
                {
                    
                    return $this->apiResponse(new Post_Resource($showone),'ok',200);
                }
                else{
                    return $this->apiResponse('NULL','This post not found',404);
                }
            } 
        // الطريقة دي لو شغال ع بوست واحد انما لو علي كل البوستات زي الاندكس فوق هستخدم
        //  $showposts=Post_Resource::collection(Post::get());
 

        
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'body' => 'required',
            ]);
     
            if ($validator->fails()) {
                return $this->apiResponse('NULL',$validator->errors(),400);// هخلي الماسدج تجيب الخطا الموجود 
            }

            // عشان احط الحوار دا ف اف لازم يبقي بال كريت 
         $store=Post::create($request->all()); // هتخزنلي كلو مرة واحدة 
        if($store)
        {
            return $this->apiResponse(new Post_Resource($store),'ok',201); // 201 دي للتخزين 
        }
        else{
            return $this->apiResponse('NULL','This post not found',400);
        }
        
        }
 
      // the update
      public function update(Request $request ,$id)
      {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->apiResponse('NULL',$validator->errors(),400);// هخلي الماسدج تجيب الخطا الموجود 
        }
        
        $getpost=Post::find($id); // عشان اتاكد ان الاي دي موجود هعمل فالديشن ع السطر دا لوةحدو الاول 

        if(!$getpost)
        {
            return $this->apiResponse('NULL','This post not found',404);
        }
    
        $getpost->update($request->all());

        if($getpost)
        {
            return $this->apiResponse(new Post_Resource($getpost),'successful',201); // 201 دي للتخزين 
        }
        else{
            return $this->apiResponse('NULL','This post not found',404);
        }
        
        }
      
      
    public function destory($id)
    {
        $des=Post::find($id);
        if(!$des)
        {
            return $this->apiResponse('NULL','This post not found',404);
        }
        $elemnt_deleted=$des;
        $des->destroy($id);
        if($des)
        {
            return $this->apiResponse(new Post_Resource($elemnt_deleted),'deleted successful',200); // 201 دي للتخزين 
        }
        else{
            return $this->apiResponse('NULL','This post not found',404);
        }
    }
    
   

}
