<?php

namespace App\Http\Requests\Treatments;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'treatment_category_id' => 'required',
            'description'           => 'required',
            'first_name'            => 'required',
            'middle_name'           => 'required',
            'last_name'             => 'sometimes',
            'status'                => 'sometimes',
            'answer'                => 'sometimes'
        ];
    }
}
