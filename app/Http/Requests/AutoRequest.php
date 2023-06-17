<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoRequest extends FormRequest
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
    public function rules():array
    {
        $rules = [
            'mark' => 'required|alpha',
            'model' => 'required|alpha_num:autos,model|regex:/[a-zA-Z][0-9]/u',
            'color' => 'required|alpha',
            'gos_number' => 'required|unique:autos,gos_number|min:8|max:9|alpha_num|regex:/[А-Я]{1}[0-9]{3}[А-Я]{2}[0-9][0-9][0-9]?/u'
        ];
        if ($this->getMethod() == "POST"){
            $rules += [
                'mark' => 'required|alpha',
                'model' => 'required|alpha_num:autos,model|regex:/[a-zA-Z][0-9]/u',
                'color' => 'required|alpha',
                'gos_number' => 'required|unique:autos,gos_number|min:8|max:9|alpha_num|regex:/[А-Я]{1}[0-9]{3}[А-Я]{2}[0-9][0-9][0-9]?/u',
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'mark.required'=>'Введите марку вашего авто',
            'model.required'=>'Введите модель вашего авто',
            'color.required'=>'Введите цвет вашего авто',
            'gos_number.required'=>'Введите правильный ГОС номер вашего авто, например А111А11(1)',
        ];
    }
}
