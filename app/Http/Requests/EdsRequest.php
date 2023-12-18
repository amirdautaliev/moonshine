<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EdsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'xml' => 'required|string'
        ];
    }
}
