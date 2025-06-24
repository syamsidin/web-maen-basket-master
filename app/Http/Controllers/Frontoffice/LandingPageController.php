<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\FieldModel;
use App\Models\ItemImageModel;
use App\Models\ItemModel;
use App\Models\RepositoryImageModel;
use App\Models\RepositoryModel;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "landing",
            "summary" => [
                "item" => ItemModel::where(['is_deleted' => 0])->count(),
                "not_used_item" => ItemModel::where(['is_deleted' => 0])->count(),
                "repository" => RepositoryModel::where(['is_deleted' => 0])->count(),
            ],
            "item_images" => ItemImageModel::orderBy('created_at', 'DESC')->take(9)->get(),
            "repository_images" => RepositoryImageModel::orderBy('created_at', 'DESC')->take(9)->get(),
            "category_gallery" => ['Barang', 'Ruangan'],
            "path_image_item" => "/show-file/images/items/",
            "path_image_repository" => "/show-file/images/repositories/",
        ];

        return view('pages/frontoffice/landing_page/index', $data);
    }
}
