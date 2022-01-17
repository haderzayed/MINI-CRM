<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
        if ($this->isMethod('POST')){
            return [
                'name' => 'required',
                'email' => 'required|unique:companies',
                'website_url'=>'required|url',
                'logo'=>'required|mimes:jpg,png,jpeg,gif|dimensions:min_width=100,min_height=100'

            ];
        }else{
            return [
                'name' => 'sometimes',
                'email' => 'sometimes|unique:companies,email,'.$this->company->id,
                'website_url'=>'sometimes|url',
                'logo'=>'sometimes|mimes:jpg,png,jpeg,gif|dimensions:min_width=100,min_height=100'

            ];
        }

    }
}

