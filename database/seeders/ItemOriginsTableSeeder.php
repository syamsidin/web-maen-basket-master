<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemOriginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'	=> 'Pengadaan Barang yang dibeli atau diperoleh atas beban APBD' ],
            [ 'name'	=> 'Hadiah/Hibah' ],
            [ 'name'	=> 'Pelaksanaan dari perjanjian/Kontrak' ],
            [ 'name'	=> 'Ketentuan Peraturan Perundang-undangan' ],
            [ 'name'	=> 'Putusan Pengadilan' ],
            [ 'name'	=> 'Divestasi' ],
            [ 'name'	=> 'Hasil Inventarisasi' ],
            [ 'name'	=> 'Hasil tukar menukar' ],
            [ 'name'	=> 'Pembatalan penghapusan' ],
            [ 'name'	=> 'Perolehan/Penerimaan Lainnya' ],
        ];

        DB::table('item_origins')->insert($data);
    }
}
