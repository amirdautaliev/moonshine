<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolEdsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'xml' => 'required|string',
            'signatory_official_number' => 'required|string',
            'official_number' => 'required|string',
        ];
    }
}
