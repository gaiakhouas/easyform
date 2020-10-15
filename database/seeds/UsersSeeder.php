<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) :
            $user = new User();
            $user->name = Str::random(10);
            $user->email = Str::random(10) . '@gmail.com';
            $user->password = Hash::make('password');
            $user->save();
        endfor;
    }
}
