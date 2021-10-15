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
                'required', 'email', 'string', 'min:5', 'max:255',
                Rule::unique('shoppers')->ignore($this->shopper)
            ],
            'avatar' => 'required|image|max:5120|dimensions:min_width=300,min_height=300',
            'password' => 'required|string|min:8|max:50',
            'admin_created_id' => 'required',
            'admin_updated_id' => 'required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if($this->phone && Str::length($this->phone) == 12) {
            $this->merge([
                'phone' => PhoneNumber::make($this->phone),
            ]);
        }
        $this->merge([
            'admin_created_id' => auth()->id(),
            'admin_updated_id' => auth()->id(),
        ]);
    }
}
