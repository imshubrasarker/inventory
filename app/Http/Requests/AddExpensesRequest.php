<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddExpensesRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'expenses_heads_id' => 'required|numeric',
            'date' => 'required',
            'note' => 'string|max:250',
        ];
    }
}
