<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpRequest extends FormRequest
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
        $rules = [
            'family' => 'required|alpha',
            'name' => 'required|alpha',
            'name_father' => 'required|alpha',
            'phone' => 'required|unique:users,phone|regex:/\+(7)\h\([0-9]{3}\)\h[0-9]{3}\-[0-9]{2}\-[0-9]{2}/|size:18',
        ];
        if ($this->getMethod() == "POST"){
            $rules += [
                'phone' => 'required|unique:users,phone|regex:/\+(7)\h\([0-9]{3}\)\h[0-9]{3}\-[0-9]{2}\-[0-9]{2}/|size:18',

            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'family.required'=>'Введите вашу фамилию',
            'name.required'=>'Введите ваше имя',
            'phone.required'=>'Введите правильный номер телефона, например +7 (777) 777-77-77',
            'name_father.required'=>'Введите ваше отчество',

        ];
    }
}
