<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required',            
            'author' => 'required',            
            'status' => 'required',            
            'category_id' => 'required',            
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A "book without a title" makes for a good title...but still, type in a title to continue',
            'status.required' => 'A status is required',
            'author.required' => 'Who wrote this book?',
            'category_id.required' => 'Cannot be blank. Users will never find what they like'
        ];
    }
}
