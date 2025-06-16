<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemModel;

class ItemController extends Controller
{
    public function show($id)
    {
        $data = [
            "page_name" => "item",
            "data" => ItemModel::find($id),
            "path_image" => "/show-file/images/items/"
        ];

        return view('pages/frontoffice/item/detail', $data);
    }
}
