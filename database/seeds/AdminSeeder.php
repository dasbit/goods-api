<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    const ADMIN = [
        'is_admin' => true,
        'login' => 'admin',
        'email' => 'admin@app.com',
        'password' => 'secret'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::whereEmail(self::ADMIN['email'])->first();
        if ($admin !== null)
            $this->command->info('admin already exists');
        else {
            $user = factory(User::class, 1)->create(array_merge(self::ADMIN, [
                'password' => app('hash')->make(self::ADMIN['password'])
            ]));
            $this->command->info("admin created");
        }
    }
}
