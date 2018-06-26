<?php

namespace Unite\Expenses\Http\Controllers;

use Unite\Expenses\ExpenseRepository;
use Unite\UniSysApi\Http\Controllers\Controller;
use Unite\Expenses\Http\Requests\UpdateRequest;

/**
 * @resource Note
 *
 * Expenses handler
 */
class ExpenseController extends Controller
{
    protected $repository;

    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update
     *
     * @param $id
     * @param \Unite\Expenses\Http\Requests\UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $data = $request->all();

        $object->update($data);

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $this->repository->delete($id);

        return $this->successJsonResponse();
    }
}
