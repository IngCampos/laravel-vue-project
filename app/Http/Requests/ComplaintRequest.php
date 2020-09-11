<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255|regex:/^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/',
            'email' => 'required|email',
            'complaint_type_id' => 'required|integer|min:1|max:3',
            'content' => 'min:10|max:255',
        ];
    }
}
