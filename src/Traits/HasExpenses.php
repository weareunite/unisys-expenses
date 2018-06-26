<?php

namespace Unite\Expenses\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Unite\Expenses\Models\Expense;

trait HasExpenses
{
    public function expenses(): MorphMany
    {
        return $this->morphMany(Expense::class, 'subject');
    }

    /**
     * @param array $data
     * @return \Unite\Expenses\Models\Expense
     */
    public function addExpense(array $data = [])
    {
        return $this->expenses()->create($data);
    }

    public function removeExpense($id)
    {
        $this->expenses()->where('id', $id)->delete();
    }

    public function existExpenses()
    {
        return $this->expenses()->exists();
    }

    public function ExpensesCount()
    {
        return $this->expenses()->count();
    }

    public function getLatestExpenses(int $limit = 20)
    {
        //todo: move it to repository for caching
        return $this->expenses()->orderBy('created_at', 'desc')->limit($limit)->get();
    }
}
