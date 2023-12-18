<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetExecutorsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'executor_id' => 'required|integer|exists:users,id',
            'main_executor_id' => 'nullable|integer|exists:users,id',
        ];
    }
}
