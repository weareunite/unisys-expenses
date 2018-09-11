<?php

namespace Unite\Expenses\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Expenses\ExpenseRepository;
use Unite\Expenses\Http\Requests\StoreRequest;
use Unite\Expenses\Http\Resources\ExpenseResource;
use Unite\Tags\Http\Controllers\AttachDetachTags;
use Unite\Transactions\Http\Controllers\HandleTransaction;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Expenses\Http\Requests\UpdateRequest;
use Unite\UnisysApi\Http\Controllers\HandleUploads;
use Unite\UnisysApi\QueryBuilder\QueryBuilder;
use Unite\UnisysApi\QueryBuilder\QueryBuilderRequest;

/**
 * @resource Expenses
 *
 * Expenses handler
 */
class ExpenseController extends Controller
{
    use AttachDetachTags;
    use HandleTransaction;
    use HandleUploads;

    protected $repository;

    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;

        $this->setResourceClass(ExpenseResource::class);
    }

    /**
     * List
     *
     * @param QueryBuilderRequest $request
     *
     * @return AnonymousResourceCollection|ExpenseResource[]
     */
    public function list(QueryBuilderRequest $request)
    {
        $object = QueryBuilder::for($this->repository, $request)
            ->paginate();

        return $this->resource::collection($object);
    }

    /**
     * Show
     *
     * @param int $id
     *
     * @return ExpenseResource
     */
    public function show(int $id)
    {
        if(!$model = $this->repository->find($id)) {
            abort(404);
        }

        $model->load('supplier', 'purchaser', 'tags');

        return new $this->resource($model);
    }

    /**
     * Create
     *
     * @param StoreRequest $request
     *
     * @return ExpenseResource
     */
    public function create(StoreRequest $request)
    {
        $object = $this->repository->create( $request->all() );

        return new $this->resource($object);
    }

    /**
     * Update
     *
     * @param int $id
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, UpdateRequest $request)
    {
        if(!$model = $this->repository->find($id)) {
            abort(404);
        }

        $model->update( $request->all() );

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $this->repository->delete($id);
        } catch(\Exception $e) {
            abort(409, 'Cannot delete record');
        }

        return $this->successJsonResponse();
    }
}
