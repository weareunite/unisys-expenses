<?php

namespace Unite\Expenses\Models;

use Illuminate\Database\Eloquent\Model;
use Unite\Expenses\Events\ItemDeleted;
use Unite\Expenses\Events\ItemSaved;

class Item extends Model
{
    protected $table = 'expense_items';

    protected $fillable = [
        'name', 'description', 'qty', 'um', 'vat', 'price', 'price_without_vat',
    ];

    protected $casts = [
        'qty'               => 'integer',
        'vat'               => 'integer',
        'price'             => 'float',
        'price_without_vat' => 'float',
    ];

    protected $dispatchesEvents = [
        'saved'    => ItemSaved::class,
        'deleted'  => ItemDeleted::class,
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function withVat(): bool
    {
        return ($this->vat !== null || $this->vat !== 0);
    }

    public function sumTotalPrice(): float
    {
        return $this->qty * $this->price;
    }

    public function sumTotalPriceWithoutVat(): float
    {
        return $this->qty * $this->price_without_vat;
    }
}
