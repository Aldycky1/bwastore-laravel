<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@onlinestore.com',
                'email_verified_at' => date('Y-m-d H:i:s', time()),
                'password' => \bcrypt('password'),
                'roles' => 'ADMIN'
            ]
        );
    }
}
