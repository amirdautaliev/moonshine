<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return 
       [
        'id'        => $this->id,
        'title_kz'  => $this->title_kz,
        'title_ru'  => $this->title_ru,
        'title_en'  => $this->title_en,
        'text_kz'   => $this->text_kz,
        'text_ru'   => $this->text_ru,
        'text_en'   => $this->text_en,
        'image'     => $this->image
        
       ];
    }
}
