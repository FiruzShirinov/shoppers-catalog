<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber;

class ShopperRequest extends FormRequest
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
            'phone' => [
                'required', 'phone:AUTO,CA',
                Rule::unique('shoppers')->ignore($this->shopper)
            ],
            'email' => [
                'required', 'email', 'string', 'min:6', 'max:255',
                Rule::unique('shoppers')->ignore($this->shopper)
            ],
            'image' => 'sometimes|required|image|max:5120|mimes:jpg,png|dimensions:min_width=300,min_height=300',
            'password' => 'sometimes|required|nullable|string|min:8|max:50',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->phone) {
            $this->merge([
                'phone' => PhoneNumber::make($this->phone),
            ]);
        }
    }
}
