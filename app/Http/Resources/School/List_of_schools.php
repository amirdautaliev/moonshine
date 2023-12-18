<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Resources\Json\JsonResource;

class List_of_schools extends JsonResource
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
            "text_kz" => $this->text_kz,
            "text_ru" => $this->text_ru,
            "text_en" => $this->text_en,
            "file"    => $this->file
        ];
    }
}
