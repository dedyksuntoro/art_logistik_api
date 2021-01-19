<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dedyk',
            'identity_id' => '12345678345',
            'gender' => 1,
            'address' => 'Jl Duluan',
            'photo' => 'artmedia.png', //note: tidak ada gambar
            'email' => 'admin@admin.com',
            'password' => app('hash')->make('adminsaja'),
            'phone_number' => '085111111',
            'api_token' => Str::random(40),
            'role' => 0,
            'status' => 1
        ]);
    }
}