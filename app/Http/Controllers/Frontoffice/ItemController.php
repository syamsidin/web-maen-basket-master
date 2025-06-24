<?php

namespace App\Http\Controllers\Frontoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemModel;

class ItemController extends Controller
{
    public function show($id)
    {
        $items = ItemModel::where(['id' => $id, 'is_deleted' => 0])->get();

        $data = [
            "page_name" => "item",
            "data" => ItemModel::find($id),
            "items" => $items,
            "path_image" => "/show-file/images/items/"
        ];
        // dd($data['data']->item_images);

        return view('pages/frontoffice/item/detail', $data);
    }
}
