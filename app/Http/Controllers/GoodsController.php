<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Good\GoodListResource;
use App\Http\Resources\Good\GoodResource;
use App\Models\Category;
use App\Models\Good;
use App\Repositories\Contracts\GoodsRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GoodsController extends Controller
{
    /**
     * @var GoodsRepositoryInterface $repository
     */
    protected $repository;

    /**
     * GoodsController constructor.
     *
     * @param GoodsRepositoryInterface $repository
     */
    public function __construct(GoodsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Goods list
     *
     * @param Request $request
     * @return GoodListResource
     */
    public function index(Request $request)
    {
        $filters = $request->input('filters', []);
        if (!empty($filters))
            return new GoodListResource($this->repository->paginateByFilters($filters, ['category', 'tags']));
        return new GoodListResource($this->repository->paginate(['category', 'tags']));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if ($user === null || $user->cannot('create', Good::class)) {
            throw new AccessDeniedException('You cannot create good');
        }
        $this->validate($request, [
            'title' => 'required|string|min:2',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
        ]);

        $good = $this->repository->create($request->all());

        return new GoodResource($good);
    }

    public function update(Request $request, int $id)
    {
        $user = $request->user();
        $good = $this->repository->find($id);
        if($good === null)
            throw new NotFoundHttpException('Good Not found');
        if ($user === null || $user->cannot('update', $good)) {
            throw new AccessDeniedException('You cannot update good');
        }
        $this->validate($request, [
            'title' => 'nullable|string|min:2',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
        ]);
        $good = $this->repository->update($good, $request->all());

        return new GoodResource($good);
    }

    public function destroy(Request $request, int $id)
    {
        $user = $request->user();
        $good = $this->repository->find($id);
        if($good === null)
            throw new NotFoundHttpException('Good Not found');
        if ($user === null || $user->cannot('delete', $good)) {
            throw new AccessDeniedException('You cannot delete good');
        }
        $good->load(['category', 'tags']);
        $old = clone $good;
        $good->delete();
        return new CategoryResource($old);
    }
}
