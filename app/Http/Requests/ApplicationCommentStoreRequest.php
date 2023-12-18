<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationCommentStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'string',
            'comment' => 'required|string',
        ];
    }
}
