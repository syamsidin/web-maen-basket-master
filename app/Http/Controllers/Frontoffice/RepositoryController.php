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
        $items = ItemModel::where(['current_repository_id' => $id, 'is_deleted' => 0])->get();

        $data = [
            "page_name" => "repository",
            "data" => RepositoryModel::find($id),
            "items" => $items,
            "path_image" => "/show-file/images/repositories/"
        ];

        return view('pages/frontoffice/repository/detail', $data);
    }
}
