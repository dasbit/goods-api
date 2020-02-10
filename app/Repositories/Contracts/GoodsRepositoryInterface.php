<?php namespace App\Repositories\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GoodsRepositoryInterface extends EloquentRepositoryInterface
{
    public function paginateByFilters(array $filters, $with = []): LengthAwarePaginator;
}
