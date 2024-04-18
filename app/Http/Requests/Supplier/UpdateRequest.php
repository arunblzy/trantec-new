<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        $supplierId = request('supplier');
        return [
            'name' => 'required|string|between:2,50',
            'email' => 'required|string|email|max:50|unique:suppliers,email,'.$supplierId,
            'phone' => 'required|unique:suppliers,phone,'.$supplierId,
            'code' => 'required|unique:suppliers',
            'fax' => 'nullable|string|between:1,255',
            'address' => 'nullable|string|between:1,255',
            'trn' => 'nullable|string|unique:suppliers,trn,'.$supplierId.'|between:1,255',
            'credit_period' => 'nullable|string|between:1,255',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'state_id' => 'nullable|exists:states,id',
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
