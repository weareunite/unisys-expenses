<?php

namespace Unite\Expenses\Http\Resources;

use Illuminate\Database\Eloquent\Builder;
use Unite\Contacts\Http\Resources\ContactResource;
use Unite\Expenses\Models\Expense;
use Unite\Tags\Http\Resources\TagResource;
use Unite\UnisysApi\Http\Resources\Resource;

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
            'hasAttachments'        => $this->hasMedia(),
            'tags'                  => TagResource::collection($this->tags),
        ];
    }

    public static function modelClass()
    {
        return Expense::class;
    }

    public static function eagerLoads()
    {
        $with = [
            'supplier',
            'purchaser',
            'tags',
            'media',
        ];

        return parent::eagerLoads()->merge($with);
    }

    public static function resourceMap()
    {
        $map = [
            'supplier'  => ContactResource::class,
            'purchaser' => ContactResource::class,
            'tags'      => TagResource::class,
        ];

        return parent::resourceMap()->merge($map);
    }

    public static function virtualFields()
    {
        $virtualFields = [
            'hasAttachments' => function (Builder &$query, $value) {
                return $query;
            }
        ];

        return parent::virtualFields()->merge($virtualFields);
    }

}
