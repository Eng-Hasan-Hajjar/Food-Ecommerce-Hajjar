<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
            'resturant_id'=>'required|exists:resturants,id',
            'name'=>'required|max:255',
            'phone'=>'required|max:255',
            'address'=>'required|max:255',
            'age'=>'required|integer|between:18,90',
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'برجاء ملي كافه البيانات ',
            '*.between' => 'العمر لابد ان لايقل عن 18 سنه ',
        ];
    }
}
