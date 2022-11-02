<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = $this->searchable;
        return [
            'id' => $data->id,
            'category_id' => $data->category_id,
            'title' => $data->title,
            'image' => $data->image,
            'description' => $data->description,
            'color' => $data->color,
            'brand' => $data->brand,
            'datetime' => $data->datetime,
            'is_lost' => $data->is_lost,
            'is_done' => $data->is_done,
            'reward' => $data->reward,
            'latitude' => $data->latitude,
            'longitude' => $data->longitude,
        ];
    }
}
