<?php

namespace Unite\Expenses\Http\Controllers;

use Unite\Expenses\Http\Requests\StoreRequest;
use Unite\Expenses\Traits\HasExpensesInterface;

trait AddExpense
{
    /**
     * Add Expense
     *
     * Add expense to model
     *
     * @param int $id
     * @param StoreRequest $request
     *
     * @return Resource
     */
    public function addExpense(int $id, StoreRequest $request)
    {
        /** @var HasExpensesInterface $object */
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $expense = $object->addExpense( $request->all() );

        $expenseResourceClass = $this->expenseResourceClass();

        return new $expenseResourceClass($expense);
    }

    abstract protected function expenseResourceClass(): string;
}
