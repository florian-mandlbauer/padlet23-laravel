<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = new User();
        $testUser->name = "Max Mustermann";
        $testUser->email = "test@gmail.com";
        $testUser->isAdmin = true;
        $testUser->password = bcrypt('secret');
        $testUser->save();
    }
}
