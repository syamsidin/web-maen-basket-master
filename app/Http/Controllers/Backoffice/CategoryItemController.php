<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\CategoryItemModel;
use App\Models\ItemModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryItemController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "category",
            "data" => CategoryItemModel::where(['is_deleted' => 0])->get()
        ];

        return view('pages/backoffice/category_item/index', $data);
    }

    public function create()
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "category"
        ];

        return view('pages/backoffice/category_item/add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "max" => "required"
        ]);

        $new_data = [
            "name" => $request->name,
            "max" => $request->max
        ];

        $new_data = CategoryItemModel::create($new_data);

        if($new_data->exists){
            Alert::success('Berhasil!', 'Data kategori berhasil ditambahkan!');
            return redirect('/backoffice/category-item');
        }
    }

    public function edit($id)
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "category",
            "data" => CategoryItemModel::find($id)
        ];

        return view('pages/backoffice/category_item/edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "max" => "required"
        ]);

        $data = CategoryItemModel::find($request->id);

        $new_data_Obj = [
            "name" => $request->name,
            "max" => $request->max
        ];

        $updated_data = $data->update($new_data_Obj);

        if($updated_data){
            Alert::success('Berhasil!', 'Data kategori berhasil diedit!');
            return redirect('/backoffice/category-item');
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $update_item = ItemModel::where(['category_id' => $request->id])->update(['category_id' => null]);
        $deleted_data = CategoryItemModel::find($request->id)->update(['is_deleted' => 1]);

        if($deleted_data){
            Alert::success('Berhasil!', 'Data kategori berhasil dihapus!');
            return redirect('/backoffice/category-item');
        }
    }
}
