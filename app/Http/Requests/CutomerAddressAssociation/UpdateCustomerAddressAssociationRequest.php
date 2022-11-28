<?php

namespace App\Http\Requests\CutomerAddressAssociation;

use App\Rules\CanAssociateWithCustomerAddresses;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerAddressAssociationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('associate-customer-address', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Exception
     */
    public function rules(): array
    {
        return [
            'customerAddresses' => [
                'required',
                'array',
                'exists:customer_addresses,id',
                new CanAssociateWithCustomerAddresses($this->user),
            ]
        ];
    }
}
