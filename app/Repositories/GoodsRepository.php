<?php


namespace App\Repositories;


use App\Models\Good;
use App\Repositories\Contracts\GoodsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GoodsRepository extends BaseRepository implements GoodsRepositoryInterface
{
    public function __construct(Good $model)
    {
        parent::__construct($model);
    }

    public function paginateByFilters(array $filters, $with = []) : LengthAwarePaginator
    {
        $query = $this->model->query()->with($with);

        if (isset($filters['name']))
            $query->where('name', '=', $filters['name']);

        //todo filters logic here

        return  $query->paginate($this->paginatePerPage);
    }
}
