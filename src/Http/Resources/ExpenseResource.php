<?php

namespace Unite\Expenses\Http\Resources;

use Unite\Contacts\Http\Resources\ContactResource;
use Unite\Tags\Http\Resources\TagResource;
use Unite\UnisysApi\Http\Resources\Resource;

class ExpenseResource extends Resource
{
    protected static $relations = [
        'supplier',
        'supplier.country',
        'purchaser',
        'purchaser.country',
        'tags'
    ];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \Unite\Expenses\Models\Expense $this->resource */
        return [
            'id'                    => $this->id,
            'type'                  => $this->type,
            'name'                  => $this->name,
            'number'                => $this->number,
            'amount'                => $this->amount,
            'amount_without_vat'    => $this->amount_without_vat,
            'supplier'              => new ContactResource($this->supplier),
            'purchaser'             => new ContactResource($this->purchaser),
            'date_issue'            => (string)$this->date_issue,
            'date_supply'           => (string)$this->date_supply,
            'date_due'              => (string)$this->date_due,
            'variable_symbol'       => $this->variable_symbol,
            'specific_symbol'       => $this->specific_symbol,
            'description'           => $this->description,
            'tags'                  => TagResource::collection($this->tags),
        ];
    }
}
