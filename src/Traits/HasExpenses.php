<?php

namespace Unite\Expenses\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Unite\Expenses\Models\Expense;

trait HasExpenses
{


    public function existExpenses(): bool
    {
        return $this->expenses()->exists();
    }

    public function expensesCount(): int
    {
        return $this->expenses()->count();
    }

    public function getLatestExpenses(int $limit = 20)
    {
        //todo: move it to repository for caching
        return $this->expenses()->orderBy('created_at', 'desc')->limit($limit)->get();
    }
}
