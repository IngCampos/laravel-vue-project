<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenderRequest extends FormRequest
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
        // TODO: Check the way to require the data in update request. 
        return [
            'internal_file' => 'boolean|nullable',
            'name' => 'min:3|max:255',
            'tender_section_id' => 'integer',
            'link' => 'active_url|nullable'
        ];
    }
}
