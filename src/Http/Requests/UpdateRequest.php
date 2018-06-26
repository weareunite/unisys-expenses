<?php

namespace Unite\Expenses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Unite\Transactions\Models\Invoice;

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
        $allRules = [
            'type'                  => 'in:'.implode(',', Invoice::getTypes()),
            'transaction_source_id' => 'integer|exists:transaction_sources,id',
            'amount'                => 'numeric',
            'variable_symbol'       => 'string|max:250|nullable',
            'specific_symbol'       => 'string|max:250|nullable',
            'description'           => 'string|max:250|nullable',
            'paid_at'               => 'date_format:"Y-m-d H:i"',
        ];

        $rules = isset($allRules[$this->name]) ? ['value' => $allRules[$this->name] ] : [];

        return $rules;
    }
}
