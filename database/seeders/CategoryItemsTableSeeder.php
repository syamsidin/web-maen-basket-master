<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryItemsTableSeeder extends Seeder
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
                'id'    => 1,
                'name'	=> 'Meja',
                'max'	=> 5,
                'is_has_pic'	=> 0,
            ],
            [
                'id'    => 2,
                'name'	=> 'Kursi',
                'max'	=> 5,
                'is_has_pic'	=> 0,
            ],
            [
                'id'    => 3,
                'name'	=> 'Lemari',
                'max'	=> 2,
                'is_has_pic'	=> 0,
            ],
            [
                'id'    => 4,
                'name'	=> 'Laptop',
                'max'	=> 10,
                'is_has_pic'	=> 1,
            ],
            [
                'id'    => 5,
                'name'	=> 'Handphone',
                'max'	=> 12,
                'is_has_pic'	=> 1,
            ],
            [
                'id'    => 6,
                'name'	=> 'Kendaraan',
                'max'	=> 20,
                'is_has_pic'	=> 1,
            ],
        ];

        DB::table('category_items')->insert($data);
    }
}
