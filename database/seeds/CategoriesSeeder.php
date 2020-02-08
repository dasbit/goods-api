<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    const COUNT = 40;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = self::COUNT - Category::count();
        if ($count > 0) {
            for($i = 0; $i < self::COUNT; $i++) //create one by one for nestable set
                factory(Category::class, 1)->create();
        }
        $this->command->info('Categories count: ' . Category::count());
    }
}
