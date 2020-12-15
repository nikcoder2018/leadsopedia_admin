<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'name' => 'required|max:64',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'roles.*'  => 'integer',
            'roles'    => 'required|array',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ];
    }
}
