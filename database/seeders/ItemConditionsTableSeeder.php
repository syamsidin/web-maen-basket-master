<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'	=> 'Baik' ],
            [ 'name'	=> 'Rusak Ringan' ],
            [ 'name'	=> 'Rusak Berat/Usang' ]
        ];

        DB::table('item_conditions')->insert($data);
    }
}
