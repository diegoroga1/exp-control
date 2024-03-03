<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=>'required',
            'email'=>'required|email',
            'permissions'=>'array',
            'roles'=>'array'
        ];

        if(!request()->id){
            $rules['password'] = 'required|confirmed';
            $rules['email'] = 'required|email|unique:users,email';
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
