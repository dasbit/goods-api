<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\Category\CategoryListResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\TreeResource;
use App\Repositories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends Controller
{
    /**
     * @var CategoriesRepositoryInterface
     */
    protected $repository;

    /**
     * CategoriesController constructor.
     *
     * @param CategoriesRepositoryInterface $repository
     */
    public function __construct(CategoriesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Categories tree
     *
     * @return TreeResource
     */
    public function tree()
    {
        $tree = $this->repository->getTree();
        return new TreeResource($tree);
    }

    /**
     * Categories pagination list
     *
     * @return CategoryListResource
     */
    public function index()
    {
        return new CategoryListResource($this->repository->paginate());
    }

    /**
     * Stores new category
     *
     * @param Request $request
     * @return CategoryResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user === null || $user->cannot('create', Category::class)) {
            throw new AccessDeniedException('You cannot create category');
        }
        $this->validate($request, [
            'name' => 'required|string|min:2',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        $category = $this->repository->create($request->all());
        return new CategoryResource($category);
    }

    /**
     * Updates category
     *
     * @param Request $request
     * @param int $id
     * @return CategoryResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, int $id)
    {
        $user = $request->user();
        $category = $this->repository->find($id);
        if($category === null)
            throw new NotFoundHttpException('Category Not found');
        if ($user === null || $user->cannot('update', $category)) {
            throw new AccessDeniedException('You cannot update category');
        }
        $this->validate($request, [
            'name' => 'nullable|string|min:2',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id'
        ]);
        $category = $this->repository->update($category, $request->all());

        return new CategoryResource($category);
    }

    /**
     * Deletes category
     *
     * @param Request $request
     * @param int $id
     * @return CategoryResource
     * @throws \Exception
     */
    public function destroy(Request $request, int $id)
    {
        $user = $request->user();
        $category = $this->repository->find($id);
        if($category === null)
            throw new NotFoundHttpException('Category Not found');
        if ($user === null || $user->cannot('delete', $category)) {
            throw new AccessDeniedException('You cannot delete category');
        }
        $old_cat = clone $category;
        $category->delete();
        return new CategoryResource($category);
    }
}
