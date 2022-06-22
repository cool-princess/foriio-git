<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'password' => bcrypt('admin'),
            'company' => 'admin',
            'person' => 'admin',
            'email' => 'user9876123james@gmail.com',
            'pwd_store' => 'admin'
        ]);
    }
}
