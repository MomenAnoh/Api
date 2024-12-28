<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post_Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);  دي معناها يرجع كل البيانات انا هخلية يرجع الي انا عاوز بس 
        return [
            // the syntax 
             
            // دي الحجات الي عاوزها ترجع بس 
            'id'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body
                // 'title'      بستخدم كدا لو مش عاوز اوضح اسم كولوم مثلا ف الدتا بيز  $this دا بمزاجي ممكن اسمية اي اسم بس كداكدا  هيجيب التايتل لاني مشاور ع النتايتل بال 
        ];
    }
}
