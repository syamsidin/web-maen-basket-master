<?php

namespace App\Imports;

use App\Models\CategoryModel;
use App\Models\FieldModel;
use App\Models\SubCategoryModel;
use App\Models\SubSubCategoryItemModel;
use App\Models\SubSubCategoryModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ItemImport implements ToCollection, WithStartRow
{
    
    public function collection(Collection $rows)
    {
        $field = null;
        $category = null;
        $sub_category = null;
        $sub_sub_category = null;

        $count_empty = 0;
        
        foreach ($rows as $row) {
            if($count_empty > 4 ) break;

            if($row[3] == null && $row[4] == null) {
                $count_empty++;
                continue;
            }

            // row[0] == level 1
            // row[1] == level 2
            // row[2] == level 3
            // row[3] == level 4
            // row[4] == level 5 (code)
            // row[5] == level 5 (name)
            // row[6] == masa manfaat
            if($row[0] != null){
                $get_prefix = substr($row[0], 0, 2);
                if($get_prefix == '1.'){
                    if($field == null) return;
                    
                    FieldModel::find($field->id)->update([
                        'code' => $row[0]
                    ]);
                }else{
                    $field = FieldModel::create([
                        'name' => $row[0]
                    ]);
                }
            }

            if($row[1] != null){
                $get_prefix = substr($row[1], 0, 2);
                if($get_prefix == '1.'){
                    if($category == null) return;

                    CategoryModel::find($category->id)->update([
                        'code' => $row[1]
                    ]);
                }else{
                    $category = CategoryModel::create([
                        'field_id' => $field->id,
                        'name' => $row[1]
                    ]);
                }
            }

            if($row[2] != null){
                $get_prefix = substr($row[2], 0, 2);
                if($get_prefix == '1.'){
                    if($sub_category == null) return;

                    SubCategoryModel::find($sub_category->id)->update([
                        'code' => $row[2]
                    ]);
                }else{
                    $sub_category = SubCategoryModel::create([
                        'category_id' => $category->id,
                        'name' => $row[2]
                    ]);
                }
            }

            if($row[3] != null){

                $get_prefix = substr($row[3], 0, 2);
                if($get_prefix == '1.'){
                    if($sub_sub_category == null) return;

                    SubSubCategoryModel::find($sub_sub_category->id)->update([
                        'code' => $row[3]
                    ]);
                }else{
                    $sub_sub_category = SubSubCategoryModel::create([
                        'sub_category_id' => $sub_category->id,
                        'name' => $row[3]
                    ]);
                }
            }

            if($row[4] != null){
                $count_empty = 0;

                $sub_sub_category_item = [
                    'sub_sub_category_id' => $sub_sub_category->id,
                    'code' => $row[4],
                    'name' => $row[5]
                ];

                if($row[6] != null){
                    $sub_sub_category_item['usage_life'] = $row[6];
                }
                
                SubSubCategoryItemModel::create($sub_sub_category_item);
            }
        }
    }

    public function startRow(): int
    {
        // row start from 4
        return 4;
    }
}
