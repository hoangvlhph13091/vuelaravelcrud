<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        // return parent::toArray($request);
        return [
                'id' => $this->id,
                'name' => $this->name,
                'price' => $this->price,
                'image' => $this->image,
                'content' => $this->content,
                'postname' => $this->post->title,
                'postID' => $this->post->id,
            ];
    }
}
