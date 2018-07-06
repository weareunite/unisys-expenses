<?php

namespace Unite\Expenses\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Expenses\ExpenseRepository;
use Unite\Expenses\Http\Resources\ExpenseResource;
use Unite\Expenses\Models\Expense;
use Unite\UniSysApi\Http\Controllers\Controller;
use Unite\Expenses\Http\Requests\UpdateRequest;
use Unite\UnisysApi\Http\Requests\QueryRequest;

/**
 * @resource Expenses
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
     * List
     *
     * @param QueryRequest $request
     *
     * @return AnonymousResourceCollection|ExpenseResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->filterByRequest($request);

        return ExpenseResource::collection($object);
    }

    /**
     * Show
     *
     * @param $id
     *
     * @return ExpenseResource
     */
    public function show(Expense $model)
    {
        $model->load('supplier', 'purchaser', 'tags');

        return new ExpenseResource($model);
    }

    /**
     * Update
     *
     * @param Expense $model
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Expense $model, UpdateRequest $request)
    {
        $model->update( $request->all() );

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param Expense $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Expense $model)
    {
        $model->delete();

        return $this->successJsonResponse();
    }
}
