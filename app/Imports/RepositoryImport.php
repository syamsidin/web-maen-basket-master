<?php

namespace App\Imports;

use App\Models\BuildingModel;
use App\Models\FloorModel;
use App\Models\RepositoryModel;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RepositoryImport implements  ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        $building = null;
        $floor = null;

        $count_empty = 0;
        
        foreach ($rows as $row) {
            if($count_empty > 4) break;

            if($row[2] == null && $row[3] == null) {
                $count_empty++;
                continue;
            }

            // row[0] == level 1
            // row[1] == level 2
            // row[2] == level 3 (code)
            // row[3] == level 3 (name)
            if($row[0] != null){
                $split_text = explode(". ", $row[0]);
                
                $building = BuildingModel::create([
                    'code' => $split_text[0],
                    'name' => $split_text[1],
                ]);
            }

            if($row[1] != null){
                $split_text = explode(". ", $row[1]);

                if(count($split_text) == 1){
                    dd('Format lantai harus memiliki titik dibelakang kode, contoh: 1.1. Basement Gedung Kantor');
                }
                
                $floor = FloorModel::create([
                    'building_id' => $building->id,
                    'code' => $split_text[0],
                    'name' => $split_text[1],
                ]);
            }

            if($row[2] != null){
                $count_empty = 0;
                
                $new_id = (string) Str::uuid();
                RepositoryModel::create([
                    'id' => $new_id,
                    'floor_id' => $floor->id,
                    'code' => $row[2],
                    'name' => $row[3],
                ]);
            }
        }
    }

    public function startRow(): int
    {
        // row start from 4
        return 4;
    }
}
