<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'max_number_of_books_allowed' => 'required',
            'status' => 'required',
            'department_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'A user without a first name is like a pet without a model!',
            'last_name.required' => 'A user without a last name is like a plant without two names!',
            'email.required' => 'A user without an address is like a person without a phone!',
            'password.required' => 'A user without a password is like a person without a name!',
            'max_number_of_books_allowed.required' => 'A user without a maximum limit is like a mat without a speed governor!',
            'status.required' => 'A user without a status is like a phone without WiFi!',
            'department_id.required' => 'A user without a department is like fries without sauce!',
        ];
    }
}
