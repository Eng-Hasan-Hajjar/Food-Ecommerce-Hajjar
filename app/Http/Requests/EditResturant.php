<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditResturant extends FormRequest
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
            'name' => 'required', 'string','unique:resturants','max:255',
            'minimum_order' => 'required',
            'delivery_charge'=>'required',
            'contact_phone' => 'required',
            'category_list.*' => 'required','exists:categories,id',
//            'email' => 'required', 'string', 'email', 'max:255', 'unique:resturants,'. $this->id,
//            'password' => 'required', 'string', 'min:8', 'confirmed',
            'district_id' => 'required', 'exists:districts,id',
            'image' => 'mimes:jpeg,bmp,png,gif,svg',
            'state'=>'in:0,1',
            'job'=>'in:0,1'
        ];
    }
}
