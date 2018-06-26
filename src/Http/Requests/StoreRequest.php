<?php

namespace Unite\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'number' => 'string|max:50',
            'supplier_id' => 'integer|exists:contacts,id',
            'purchaser_id' => 'integer|exists:contacts,id',
            'date_issue' => 'date_format:Y-m-d',
            'date_supply' => 'date_format:Y-m-d',
            'date_due' => 'date_format:Y-m-d',
            'variable_symbol'       => 'numeric|max:10|nullable',
            'specific_symbol'       => 'numeric|max:10|nullable',
            'description'           => 'string|max:250|nullable',
            'custom_properties' => 'json|nullable',
        ];


    }
}
