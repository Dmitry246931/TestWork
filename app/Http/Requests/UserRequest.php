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
        $rules = [
            'family' => 'required|alpha',
            'name' => 'required|alpha',
            'name_father' => 'required|alpha',
            'phone' => 'required|unique:users,phone|regex:/\+(7)\h\([0-9]{3}\)\h[0-9]{3}\-[0-9]{2}\-[0-9]{2}/|size:18',
            'gen' => '',
            'mark' => 'required',
            'model' => 'required|alpha_num:autos,model|regex:/[a-zA-Z][0-9]/u',
            'color' => 'required',
            'gos_number' => 'required|unique:autos,gos_number|size:8|alpha_num|regex:/[А-Я]{1}[0-9]{3}[А-Я]{2}[0-9][0-9][0-9]?/u',
            'address' => 'required'
        ];
        if ($this->getMethod() == "POST"){
            $rules += [
                'phone' => 'required|unique:users,phone|regex:/\+(7)\h\([0-9]{3}\)\h[0-9]{3}\-[0-9]{2}\-[0-9]{2}/|size:18',
                'gos_number' => 'required|unique:autos,gos_number|size:8|alpha_num|regex:/[А-Я]{1}[0-9]{3}[А-Я]{2}[0-9]{2}/u',
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
            'mark.required'=>'Введите марку вашего авто',
            'model.required'=>'Введите модель вашего авто',
            'color.required'=>'Введите цвет вашего авто',
            'gos_number.required'=>'Введите правильный ГОС номер вашего авто, например А111А11(1)',
            'address.required'=>'Введите адрес',
            'name_father.required'=>'Введите ваше отчество',

        ];
    }
}
