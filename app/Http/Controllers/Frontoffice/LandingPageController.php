<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\CategoryItemModel;
use App\Models\ItemModel;
use App\Models\RepositoryModel;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "landing",
            "summary" => [
                "item" => ItemModel::where(['current_status_id' => 1, 'is_deleted' => 0])->count(),
                "not_used_item" => ItemModel::where('current_status_id', '!=' , 1)->where(['is_deleted' => 0])->count(),
                "repository" => RepositoryModel::where(['is_deleted' => 0])->count(),
            ],
            "category_items" => CategoryItemModel::get(),
            "items" => ItemModel::where(['is_deleted' => 0])->get(),
            "path_image" => "/show-file/images/items/"
        ];

        return view('pages/frontoffice/landing_page/index', $data);
    }
}
