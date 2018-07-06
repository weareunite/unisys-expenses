<?php

namespace Unite\Expenses\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasExpensesInterface
{
    public function expenses(): MorphMany;

    public function addExpense(array $data = []): Model;

    public function removeExpense(int $id);

    public function existExpenses(): bool;

    public function expensesCount(): int;
}
