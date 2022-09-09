<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditClient extends FormRequest
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

                'name' => ['required', 'string','max:255'],
                'phone' => ['required','max:14'],
                'district_id' => ['required', 'exists:districts,id'],
                'image' => 'mimes:jpeg,bmp,png,gif,svg',
            ];

    }
}
