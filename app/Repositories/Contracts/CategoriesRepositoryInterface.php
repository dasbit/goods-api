<?php


namespace App\Repositories\Contracts;


interface CategoriesRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTree();
}
