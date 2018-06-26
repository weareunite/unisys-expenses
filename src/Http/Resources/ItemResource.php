<?php

namespace Unite\Expenses\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ItemResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \Unite\Expenses\Models\Item $this ->resource */
        return [
            'id'                => $this->id,
            'expense_id'        => $this->expense_id,
            'name'              => $this->name,
            'description'       => $this->description,
            'qty'               => $this->qty,
            'um'                => $this->um,
            'vat'               => $this->vat,
            'price'             => $this->price,
            'price_without_vat' => $this->price_without_vat,
        ];
    }
}