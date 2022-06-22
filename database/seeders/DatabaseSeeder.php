<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'password' => bcrypt('user'),
            'company' => 'user',
            'person' => 'user',
            'email' => 'user9876123james@gmail.com',
            'pwd_store' => 'user'
        ]);
    }
}
