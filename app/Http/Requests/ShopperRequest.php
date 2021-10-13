<?php

namespace App\Http\Requests;

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
                'required', 'email', 'string', 'min:5', 'max:255',
                Rule::unique('shoppers')->ignore($this->shopper)
            ],
            'password' => 'sometimes|required|string|min:8|max:50',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => PhoneNumber::make($this->phone, 'CA')->formatE164(),
            'admin_created_id' => auth()->id(),
            'admin_updated_id' => auth()->id(),
        ]);
    }
}
