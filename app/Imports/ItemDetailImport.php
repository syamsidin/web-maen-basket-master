<?php

namespace App\Imports;

use App\Models\ItemConditionModel;
use App\Models\ItemModel;
use App\Models\ItemOriginModel;
use App\Models\ItemUnitModel;
use App\Models\SubSubCategoryItemModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class ItemDetailImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key=>$row) {
            if(count($row) == 1) break;

            // row[1] == sub sub category item model code 
            // row[2] == entry date
            // row[3] == entry year
            // row[4] == price
            // row[5] == qty
            // row[6] == item unit
            // row[7] == popular name
            // row[8] == item origin
            // row[9] == item condition
            // row[10] == pic name
            
            $sub_sub_category_item = SubSubCategoryItemModel::where(['code' => $row[1]])->first();
            $item_unit = ItemUnitModel::where(['name' => $row[6]])->first();
            $item_origin = ItemOriginModel::where(['name' => $row[8]])->first();
            $item_condition = ItemConditionModel::where(['name' => $row[9]])->first();

            if($sub_sub_category_item == null || $item_unit == null || $item_origin == null || $item_condition == null)
                return;

            $new_id = (string) Str::uuid();
            $regist_number = $this->generateRegistrationNumber();

            $new_data = [
                "id" => $new_id,
                "sub_sub_category_item_id" => $sub_sub_category_item->id,
                "item_origin_id" => $item_origin->id,
                "item_condition_id" => $item_condition->id,
                "item_unit_id" => $item_unit->id,
                "entry_year" => $row[3],
                "entry_date" => date('Y-m-d', $this->ExcelDateToUnix($row[2])),
                "price" => $row[4],
                "qty" => $row[5],
                "popular_name" => $row[7],
                "registration_number" => $regist_number
            ];

            if($row[10] != null || $row[10] != '' || $row[10] != '-'){
                $new_data['pic_name'] = $row[10];
            }
            
            ItemModel::create($new_data);
        }
    }

    public function startRow(): int
    {
        // row start from 1
        return 3;
    }
    
    public function generateRegistrationNumber()
    {
        $year = date('Y');
        $month = date('m');

        $number = ItemModel::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;
        $number = str_pad($number, 4, '0', STR_PAD_LEFT);

        return $year . $month . $number;
    }
    
    public function ExcelDateToUnix($dateValue = 0) {         
        return ($dateValue - 25569) * 86400;     
    }
}
