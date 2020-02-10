<?php

namespace App\Http\Resources\Good;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GoodListResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return GoodResource::collection($this->collection);
    }
}
