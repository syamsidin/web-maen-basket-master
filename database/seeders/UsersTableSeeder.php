<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'    => (string) Str::uuid(),
                'role'	=> 'superadmin',
                'name'	=> 'Superadmin',
                'username'	=> 'superadmin',
                'password'	=> Hash::make('super4dm1nBask3t')
            ]
        ];

        DB::table('users')->insert($data);
    }
}
