<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'	=> 'Buah' ],
            [ 'name'	=> 'Bidang' ],
            [ 'name'	=> 'Unit' ],
            [ 'name'	=> 'Set' ],
            [ 'name'	=> 'Ekor' ],
            [ 'name'	=> 'M2 (em buadrat)' ],
            [ 'name'	=> 'Exp' ],
            [ 'name'	=> 'Unit' ],
            [ 'name'	=> 'Lokal' ],
            [ 'name'	=> 'Gedung' ],
            [ 'name'	=> 'Paket' ]
        ];

        DB::table('item_units')->insert($data);
    }
}
