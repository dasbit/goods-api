<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    const ADMIN = [
        'login' => 'admin',
        'email' => 'admin@app.com',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //todo change to use Repo
        $admin = User::whereEmail(self::ADMIN['email'])->first();
        if ($admin !== null)
            $this->command->info('admin already exists');
        else {
            $user = factory(User::class, 1)->create(self::ADMIN);
            $this->command->info("admin created");
        }
    }
}
