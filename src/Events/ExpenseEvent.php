<?php

namespace Unite\Expenses\Events;

use Illuminate\Queue\SerializesModels;
use Unite\Expenses\Models\Expense;

abstract class ExpenseEvent
{
    use SerializesModels;

    public $expense;

    /**
     * Create a new event instance.
     *
     * @param  Expense $object
     */
    public function __construct(Expense $object)
    {
        $this->expense = $object;
    }
}