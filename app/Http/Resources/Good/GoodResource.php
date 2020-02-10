<?php

namespace App\Http\Resources\Good;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Tag\TagListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'tags' => new TagListResource($this->tags),
            'category' => new CategoryResource($this->category)
        ];
    }
}
