<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'teranskop',
            'roles' => 'Admin',
            'email' => 'admin@teranskop.com',
            'email_verified_at' => now(),
            'password' => Hash::make('teranskop'),
            'remember_token' => Str::random(10),
        ]);
    }
}
