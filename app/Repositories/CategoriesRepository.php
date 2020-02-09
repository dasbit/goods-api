<?php namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface {

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
