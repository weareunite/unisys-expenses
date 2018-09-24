<?php

namespace Unite\Expenses\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Expenses\ExpenseRepository;
use Unite\Expenses\Http\Requests\StoreRequest;
use Unite\Expenses\Http\Resources\ExpenseResource;
use Unite\Tags\Http\Controllers\AttachDetachTags;
use Unite\Transactions\Http\Controllers\HandleTransaction;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Expenses\Http\Requests\UpdateRequest;
use Unite\UnisysApi\Http\Controllers\HandleUploads;
use Unite\UnisysApi\Http\Controllers\HasExport;
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
    use HasExport;

    protected $repository;

    public function __construct(ExpenseRepository $repository)
    {
        $this->repository = $repository;

        $this->setResourceClass(ExpenseResource::class);

        $this->setResponse();

        $this->middleware('cache')->only(['list', 'show', 'export']);
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
            ->setVirtualFields($this->resource::virtualFields())
            ->paginate();

        return $this->response->collection($object);
    }

    /**
     * Show
     *
     * @param int $id
     *
     * @return Resource|ExpenseResource
     */
    public function show(int $id)
    {
        if(!$model = $this->repository->find($id)) {
            abort(404);
        }

        $model->load('supplier', 'purchaser', 'tags');

        return $this->response->resource($model);
    }

    /**
     * Create
     *
     * @param StoreRequest $request
     *
     * @return Resource|ExpenseResource
     */
    public function create(StoreRequest $request)
    {
        $object = $this->repository->create( $request->all() );

        \Cache::tags('response')->flush();

        return $this->response->resource($object);
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

        \Cache::tags('response')->flush();

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

        \Cache::tags('response')->flush();

        return $this->successJsonResponse();
    }
}
