<?php

namespace Unite\Expenses\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'expense_items';

    protected $fillable = [
        'name', 'description', 'qty', 'um', 'vat', 'price', 'price_without_vat',
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function withVat()
    {
        return ($this->vat !== null || $this->vat !== 0);
    }
}
