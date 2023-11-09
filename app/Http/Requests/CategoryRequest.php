<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;


class CategoryRequest extends FormRequest
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
            'name.az' => 'required|max:55',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  Lang::get('validation.required', ['attribute' => ':attribute']),
        ];
    }
}
