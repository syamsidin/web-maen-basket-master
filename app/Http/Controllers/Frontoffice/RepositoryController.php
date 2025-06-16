<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\CategoryItemModel;
use App\Models\ItemModel;
use App\Models\RepositoryModel;
use Illuminate\Support\Facades\DB;

class RepositoryController extends Controller
{
    public function show($id)
    {
        $item_per_category = ItemModel::where(['current_repository_id' => $id, 'is_deleted' => 0])
        ->select('category_id', DB::raw('count(*) as total'))->groupBy('category_id')->get();

        foreach($item_per_category as $group_category){
            $category = CategoryItemModel::find($group_category->category_id);
            $group_category['category_name'] = $category->name;
        }

        $item_per_category = $item_per_category->sortBy('category_name');

        $data = [
            "page_name" => "item",
            "data" => RepositoryModel::find($id),
            "item_per_category" => $item_per_category,
            "path_image" => "/show-file/images/repositories/"
        ];

        return view('pages/frontoffice/repository/detail', $data);
    }
}
