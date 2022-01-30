<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
             $this->collection->transform(function($page){
                return [
                    'title'     => $page->title,
                    'srock'     => $page->stock,
                ];
            }),
        ];    
    }
}
