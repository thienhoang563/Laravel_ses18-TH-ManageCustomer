<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationFormRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:20',
            'email' => 'required|regex:/^.+@.+$/i',
            'dob' => 'date',
        ];
    }

    public function messages()
    {
        $messages = [
            'name.min' => 'Tên phải ít nhất 2 chữ cái',
            'name.max' => 'Tên dài nhất là 20 chữ cái',
        ];
            return $messages;
    }
}
