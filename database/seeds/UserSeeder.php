<?php

use Illuminate\Database\Seeder;
use App\User;
User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'is_admin' => 1]);

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}
