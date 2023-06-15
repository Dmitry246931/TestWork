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
            'family' => 'required|alpha',
            'name' => 'required|alpha',
            'name_father' => 'required|alpha',
            'phone' => 'required|regex:/\+(7)\h\([0-9]{3}\)\h[0-9]{3}\-[0-9]{2}\-[0-9]{2}/|size:18',
            'gen' => '',
            'mark' => 'required',
            'model' => 'required|alpha_num:autos,model|regex:/[a-zA-Z][0-9]/u',
            'color' => 'required',
            'gos_number' => 'required|unique:autos,gos_number|min:8|max:9|alpha_num|regex:/[А-Я]{1}[0-9]{3}[А-Я]{2}[0-9][0-9][0-9]?/u',
            'address' => 'required',

        ];
    }
}
