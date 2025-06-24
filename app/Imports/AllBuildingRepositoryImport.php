<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllBuildingRepositoryImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        //shets imported should have this all fields as it sheets
        return [
            '1. GEDUNG KANTOR' => new RepositoryImport(),
            '2. GEDUNG AULA' => new RepositoryImport(),
            '3. GEDUNG KELAS' => new RepositoryImport(),
            '4. TWIN TOWER A' => new RepositoryImport(),
            '5. TWIN TOWER B' => new RepositoryImport(),
            '6. WISMA' => new RepositoryImport(),
        ];
    }
}
