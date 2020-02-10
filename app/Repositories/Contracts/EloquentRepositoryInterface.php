<?php


namespace App\Repositories\Contracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param Model $model
     * @param array $attributes
     * @return Model
     */
    public function update(Model $model, array $attributes): Model;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param array $with
     * @return LengthAwarePaginator
     */
    public function paginate($with = []): LengthAwarePaginator;
}
