<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                'email' => 'required|unique:users',
                'role'=>'required|in:super_admin,sub_admin',
                'password' => 'required|string|min:6|confirmed',
            ];
        }else{
            return [
                'name' => 'sometimes',
                'email' => 'sometimes|unique:companies,email,'.$this->admin->id,
                'role'=>'sometimes|in:super_admin,sub_admin'
            ];
        }
    }
}
