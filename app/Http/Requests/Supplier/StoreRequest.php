<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:2,50',
            'email' => 'required|string|email|max:50|unique:suppliers,email',
            'phone' => 'required|unique:suppliers',
            'code' => 'required|unique:suppliers',
            'fax' => 'nullable|string|between:1,50',
            'address' => 'nullable|string|between:1,255',
            'trn' => 'nullable|string|unique:suppliers|between:1,50',
            'credit_period' => 'nullable|string|between:1,50',
            'country' => 'nullable|exists:countries,id',
            'city' => 'nullable|exists:cities,id',
            'state' => 'nullable|exists:states,id',
            'vendor_category' => 'nullable|array',
            'vendor_category.*' => 'required|exists:vendor_categories,id',
            'contact_description.*' => 'required',
            'contact_phone.*' => 'required',
            'contact_mobile.*' => 'required',
            'contact_email.*' => 'required|email',
            'contact_fax.*' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            throw new HttpResponseException(
                sendValidationErrorResponse($validator->errors(), 'Validation failed.')
            );
        }
        parent::failedValidation($validator);
    }
}
