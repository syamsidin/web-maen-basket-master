<?php

namespace App\Http\Controllers\Backoffice\API;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\SubSubCategoryItemModel;
use App\Models\SubSubCategoryModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemController extends Controller
{
    
    public function get_categories($field_id)
    {
        $data = CategoryModel::where(['field_id' => $field_id])->orderBy('name')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_sub_categories($category_id)
    {
        $data = SubCategoryModel::where(['category_id' => $category_id])->orderBy('name')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_sub_sub_categories($sub_category_id)
    {
        $data = SubSubCategoryModel::where(['sub_category_id' => $sub_category_id])->orderBy('name')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_sub_sub_category_items($sub_sub_category_id)
    {
        $data = SubSubCategoryItemModel::where(['sub_sub_category_id' => $sub_sub_category_id])->orderBy('name')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_sub_sub_category_item_detail($id)
    {
        $data = SubSubCategoryItemModel::find($id);

        $data['field_name'] = $data->sub_sub_category->sub_category->category->field->name;

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_qr_code($id)
    {
        $data = (string) QrCode::size(200)->generate(url('/item/' . $id));

        return response()->json(['message' => 'success', 'data' => $data]);
    }
}
