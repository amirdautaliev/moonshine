<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'school_name' => 'required|string',
            'actual_address' => 'required|string',
            'organization_id' => 'required|integer|exists:users,id'
        ];
    }
}
