<?php

namespace Unite\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Unite\Expenses\Models\Expense;
use Unite\UnisysApi\Rules\PriceAmount;

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
            'type'                  => 'nullable|in:'.implode(',', Expense::getTypes()),
            'name'                  => 'string|max:50',
            'amount'                => [new PriceAmount],
            'amount_without_vat'    => ['nullable', new PriceAmount],
            'number'                => 'nullable|string|max:50',
            'supplier_id'           => 'nullable|integer|exists:contacts,id',
            'purchaser_id'          => 'integer|exists:contacts,id',
            'date_issue'            => 'nullable|date_format:Y-m-d',
            'date_supply'           => 'nullable|date_format:Y-m-d',
            'date_due'              => 'nullable|date_format:Y-m-d',
            'variable_symbol'       => 'nullable|digits_between:0,10',
            'specific_symbol'       => 'nullable|digits_between:0,10',
            'description'           => 'nullable|string|max:250',
            'custom_properties'     => 'nullable|array',
        ];
    }
}
