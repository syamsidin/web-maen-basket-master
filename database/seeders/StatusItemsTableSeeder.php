<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusItemsTableSeeder extends Seeder
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
                'name'	=> 'Aktif',
            ],
            [
                'id'    => 2,
                'name'	=> 'Tidak Aktif',
            ],
            [
                'id'    => 3,
                'name'	=> 'Rusak Ringan 30%',
            ],
            [
                'id'    => 4,
                'name'	=> 'Rusak Sedang 30-60%',
            ],
            [
                'id'    => 5,
                'name'	=> 'Rusak Berat 60% +',
            ],
            [
                'id'    => 6,
                'name'	=> 'Jual',
            ],
            [
                'id'    => 7,
                'name'	=> 'Hibah',
            ],
            [
                'id'    => 8,
                'name'	=> 'Pindah Tangan',
            ],
            [
                'id'    => 9,
                'name'	=> 'Penghapusan',
            ],
        ];

        DB::table('status_items')->insert($data);
    }
}
