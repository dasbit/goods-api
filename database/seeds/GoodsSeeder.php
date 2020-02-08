<?php

use App\Models\Good;
use Illuminate\Database\Seeder;

class GoodsSeeder extends Seeder
{
    const COUNT = 1000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = self::COUNT - Good::count();
        if ($count > 0) {
            for($i = 0; $i < self::COUNT; $i++) //create one by one for nestable set
                factory(Good::class, 1)->create();
        }
        $this->command->info('Goods count: ' . Good::count());
    }
}
