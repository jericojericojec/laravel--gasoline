<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class transactionRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'fuel_type' => 'required', 
            'price_per_ltr' => 'required', 
            'purchase_amount' => 'required', 
            'vat' => 'required', 
            'total_amount' => 'required',
            'number_of_liters' =>  array('required', 'not_in:0','regex:/^[0-9]+/'),
        ];
        return $rules;
    }

    public function messages() {

        return [
            'required'  => "Field is required.",
            'number_of_liters.regex' => 'Error: Cannot be negative and 0.',
            'number_of_liters.not_in' => 'Error: Cannot be negative and 0.',
        ];
    }
}
