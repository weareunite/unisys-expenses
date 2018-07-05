<?php

namespace Unite\Expenses\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Unite\Contacts\Http\Resources\ContactResource;
use Unite\Tags\Http\Resources\TagResource;

class ExpenseResource extends Resource
{
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
            'id'                => $this->id,
            'type'              => $this->type,
            'name'              => $this->name,
            'number'            => $this->number,
            'supplier'          => new ContactResource($this->supplier),
            'purchaser'         => new ContactResource($this->purchaser),
            'date_issue'        => (string)$this->date_issue,
            'date_supply'       => (string)$this->date_supply,
            'date_due'          => (string)$this->date_due,
            'amount_to_pay'     => $this->amount_to_pay,
            'variable_symbol'   => $this->variable_symbol,
            'specific_symbol'   => $this->specific_symbol,
            'description'       => $this->description,
            'items'             => ItemResource::collection($this->items),
            'tags'              => TagResource::collection($this->tags),
        ];
    }
}
