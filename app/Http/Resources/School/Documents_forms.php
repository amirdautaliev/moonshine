<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Resources\Json\JsonResource;

class Documents_forms extends JsonResource
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
            'image'   => $this->image,
            'text_kz' => $this->text_kz,
            'text_ru' => $this->text_ru,
            'text_en' => $this->text_en,
            'link_kz' => $this->link_kz,
            'link_ru' => $this->link_ru,
            'link_en' => $this->link_en,
            'file_kz' => $this->file_kz,
            'file_ru' => $this->file_ru,
            'file_en' => $this->file_en,
        ];
    }
}
