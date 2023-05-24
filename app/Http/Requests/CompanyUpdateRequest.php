<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'email'         => 'required|email|unique:companies,email,' . $this->company->id ,
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
            'name.required' => 'Name is required!',
            'tax_number.required' => 'Tax number is required!',
            'phone_number.required' => 'Phone number is required!',
            'email.required' =>'Email is required!',
            'email.unique' => 'Email is alredy used!',
        ];
    }
}
