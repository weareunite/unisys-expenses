<?php

namespace Unite\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'                  => 'nullable|string|max:50',
            'number'                => 'string|max:50',
            'supplier_id'           => 'integer|exists:contacts,id',
            'purchaser_id'          => 'integer|exists:contacts,id',
            'date_issue'            => 'nullable|date_format:Y-m-d',
            'date_supply'           => 'nullable|date_format:Y-m-d',
            'date_due'              => 'nullable|date_format:Y-m-d',
            'variable_symbol'       => 'nullable|numeric|max:10',
            'specific_symbol'       => 'nullable|numeric|max:10',
            'description'           => 'nullable|string|max:250',
            'custom_properties'     => 'nullable|json',
        ];
    }
}
