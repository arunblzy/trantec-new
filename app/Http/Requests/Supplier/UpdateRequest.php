<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
            'code' => 'required|unique:suppliers,code,'.$supplierId,
            'fax' => 'nullable|string|between:1,255',
            'address' => 'nullable|string|between:1,255',
            'trn' => 'nullable|string|unique:suppliers,trn,'.$supplierId.'|between:1,255',
            'credit_period' => 'nullable|string|between:1,255',
            'country' => 'nullable|exists:countries,id',
            'city' => 'nullable|exists:cities,id',
            'state' => 'nullable|exists:states,id',
            'vendor_category' => 'nullable|array',
            'vendor_category.*' => 'required|exists:vendor_categories,id',
            'contact_description.*' => 'required',
            'contact_phone.*' => [
                'required',
                Rule::unique('supplier_contacts', 'phone')->where(function ($query) use ($supplierId) {
                    return $query->whereNot('supplier_id', $supplierId);
                })
            ],
            'contact_mobile.*' => [
                'required',
                Rule::unique('supplier_contacts', 'mobile')->where(function ($query) use ($supplierId) {
                    return $query->whereNot('supplier_id', $supplierId);
                })
            ],
            'contact_email.*' => [
                'required',
                'email',
                Rule::unique('supplier_contacts', 'email')->where(function ($query) use ($supplierId) {
                    return $query->whereNot('supplier_id',$supplierId);
                })
            ],
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
