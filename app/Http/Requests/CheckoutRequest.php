<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'address_one' => 'required|string|max:255',
            'provinces_id' => 'required',
            'regencies_id' => 'required',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'phone_number' => 'required|string',
        ];
    }
}
