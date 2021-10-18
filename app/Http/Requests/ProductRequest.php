<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:256',
            'SKU' => 'required|string|min:2|max:256',
            'price' => 'required|numeric|min:1|max:999999',
            'image' => 'sometimes|required|image|max:5120|mimes:jpg,png|dimensions:min_width=300,min_height=300',
        ];
    }
}
