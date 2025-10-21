<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUser();
    }

    public function createUser()
    {
        $user = new User();
        $user->name = "John Doe";
        $user->email = 'email.test@gmail.com';
        $user->password = Hash::make('123456');
        $user->save();

        return $user;
    }
}
