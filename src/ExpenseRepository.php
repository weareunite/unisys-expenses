<?php

namespace Unite\Expenses;

use Unite\UnisysApi\Repositories\Repository;
use Unite\Expenses\Models\Expense;

class ExpenseRepository extends Repository
{
    protected $modelClass = Expense::class;
}