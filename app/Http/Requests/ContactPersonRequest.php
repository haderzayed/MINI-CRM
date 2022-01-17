<?php

namespace App\Http\Requests;

use App\Models\ContactPerson;
use Illuminate\Foundation\Http\FormRequest;

class ContactPersonRequest extends FormRequest
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
                'first_name'=>'required',
                'last_name'=>'required',
                'email' => 'required|unique:contact_people',
                //'phone'=>'required|digits_between:9,10|regex:/(01)[0-9]{9}/',
                'phone'=>'required|digits:11|regex:/(01)[0-9]{9}/',
                'linkedin_url'=>'url',
                'company_id'=>'required|exists:companies,id',
            ];
        }else{
            return [
                'first_name'=>'sometimes',
                'last_name'=>'sometimes',
                'email' => 'sometimes|unique:contact_people,email,'.$this->ContactPerson->id,
                //'phone'=>'required|digits_between:9,10|regex:/(01)[0-9]{9}/',
                'phone'=>'sometimes|digits:11|regex:/(01)[0-9]{9}/',
                'linkedin_url'=>'url',
                'company_id'=>'sometimes|exists:companies,id',
            ];
        }
    }
}
