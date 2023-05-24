<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

   /**
     * Get the validation rules that apply to the request.
     *
     * @return array;
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string',
            'tax_number'    => 'required|string',
            'phone_number'  => 'required|string',
            'email'         => 'required|email|unique:App\Models\Company,email',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => back()->with('error', 'Name is required!'),
            'tax_number.required' => back()->with('error', 'Tax number is required!'),
            'phone_number.required' => back()->with('error', 'Phone number is required!'),
            'email.required' => back()->with('error', 'Email is required!'),
            'email.unique' => back()->with('error', 'Email is alredy used!'),
        ];
    }
}
