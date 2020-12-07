<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\users;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Users::create(['username' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'usertype' => 'admin']);
    }
}
