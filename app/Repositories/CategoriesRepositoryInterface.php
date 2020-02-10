<?php


namespace App\Repositories;


interface CategoriesRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTree();
}
