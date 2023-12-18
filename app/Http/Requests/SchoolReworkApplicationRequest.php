<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolReworkApplicationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'required|string',
            'comment' => 'required|string'
        ];
    }
}
