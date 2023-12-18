<?php

namespace App\Http\Resources\Investor;

use Illuminate\Http\Resources\Json\JsonResource;

class investor_faq_for_school extends JsonResource
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
            "question_kz" => $this->question_kz,
            "answer_kz"   => $this->answer_kz,
            "question_ru" => $this->question_ru,
            "answer_ru"   => $this->answer_ru,
            "question_en" => $this->question_kz,
            "answer_en"   => $this->answer_en,
        ];
    }
}
