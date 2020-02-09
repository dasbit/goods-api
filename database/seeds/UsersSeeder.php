<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    const COUNT = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = self::COUNT - User::count();
        if ($count > 0) {
            factory(User::class, $count)->create();
        }
        $this->command->info('Users count: ' . User::count());
    }
}
