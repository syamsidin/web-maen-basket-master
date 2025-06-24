<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllFieldsItemImport implements WithMultipleSheets 
{
    public function sheets(): array
    {
        //shets imported should have this all fields as it sheets
        return [
            '1. TANAH' => new ItemImport(),
            '2. PERALATAN DAN MESIN' => new ItemImport(),
            '3. GEDUNG DAN BANGUNAN' => new ItemImport(),
            '4. JALAN, JARINGAN DAN IRIGASI' => new ItemImport(),
            '5. ASET TETAP LAINNYA' => new ItemImport(),
            '6. KONSTRUKSI DALAM PENGERJAAN' => new ItemImport(),
        ];
    }
}
