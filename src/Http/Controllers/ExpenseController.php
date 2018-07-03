<?php

namespace Unite\Expenses\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Expenses\ExpenseRepository;
use Unite\Expenses\Http\Resources\ExpenseResource;
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
     * @return ExpenseResource
     */
    public function show($id)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        return new ExpenseResource($object);
    }

    /**
     * Update
     *
     * @param $id
     * @param UpdateRequest $request
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
