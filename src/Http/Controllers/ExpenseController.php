<?php

namespace Unite\Expenses\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Expenses\ExpenseRepository;
use Unite\Expenses\Http\Resources\ExpenseResource;
use Unite\Expenses\Models\Expense;
use Unite\Tags\Http\Requests\AttachRequest;
use Unite\Tags\Http\Requests\DetachRequest;
use Unite\Tags\Http\Requests\MassAttachRequest;
use Unite\UnisysApi\Http\Controllers\Controller;
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

    /**
     * Attach Tags
     *
     * @param Expense $model
     * @param AttachRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachTags(Expense $model, AttachRequest $request)
    {
        $data = $request->only(['tag_names']);

        $model->attachTags($data['tag_names']);

        return $this->successJsonResponse();
    }

    /**
     * Mass Attach Tags
     *
     * @param MassAttachRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function massAttachTags(MassAttachRequest $request)
    {
        $data = $request->only(['ids', 'tag_names']);

        foreach ($data['ids'] as $model_id) {
            if($object = $this->repository->find($model_id)) {
                $object->attachTags($data['tag_names']);
            }
        }

        return $this->successJsonResponse();
    }

    /**
     * Detach tags
     *
     * @param Expense $model
     * @param DetachRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachTags(Expense $model, DetachRequest $request)
    {
        $data = $request->only('tag_names');

        $model->detachTags($data['tag_names']);

        return $this->successJsonResponse();
    }
}
