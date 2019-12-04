<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSupplierRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'balance' => 'numeric|required',
            'quantity' => 'numeric|required',
            'mobile' => 'string|required|max:17',
            'address' => 'string|required|max:80',
            'note' => 'max:80'
        ];
    }
}
