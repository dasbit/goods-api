<?php

namespace App\Http\Resources\Category;

use App\Models\Category;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryListResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return CategoryResource::collection($this->collection);
    }
}
