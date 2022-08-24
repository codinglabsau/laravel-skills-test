<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPostRequest extends FormRequest
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
            'name'=> 'required|min:3|max:255',
            'Description'=>'required|min:10|max:255',
            'UserID'=>'required',
            'imagePath'=>'mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
