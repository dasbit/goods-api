<?php namespace App\Repositories;

use App\Models\Category;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface {

    protected $model = Category::class;

}
