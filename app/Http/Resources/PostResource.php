<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'color' => $this->color,
            'brand' => $this->brand,
            'datetime' => $this->datetime,
            'is_lost' => $this->is_lost,
            'is_done' => $this->is_done,
            'reward' => $this->reward,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
