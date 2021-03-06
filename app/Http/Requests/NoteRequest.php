<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'short_description' => 'required',
            'description' => 'required',
            'pictures.*' => 'mimes:jpeg,bmp,png'
        ];
    }

    public function messages(){
        return [
            'short_description.required' => 'Short description is required',
          'description.required' => 'The field description is required!',
            'pictures.*.mimes' => 'Upload bad format picture (jpeg, bpm, png)'
        ];
    }
}
