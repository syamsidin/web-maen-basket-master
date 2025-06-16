<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\CategoryItemModel;
use App\Models\ItemModel;
use App\Models\RepositoryItemModel;
use App\Models\StatusItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemController extends Controller
{
    public function index()
    {
        $all_item = ItemModel::where(['current_status_id' => 1, 'is_deleted' => 0])->get();
        foreach($all_item as $item){
            // $item['qrcode'] = (string) QrCode::size(400)->generate(json_encode(['id' => $item->id]));
            $item['qrcode'] = (string) QrCode::size(400)->generate(url('/item/' . $item->id));
        }

        $data = [
            "page_name" => "item",
            "sub_page_name" => "used",
            "data" => $all_item
        ];

        return view('pages/backoffice/item/index', $data);
    }

    public function create()
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "used",
            "categories" => CategoryItemModel::where(['is_deleted' => 0])->get(),
            "category_has_pic_ids" => CategoryItemModel::where(['is_deleted' => 0, 'is_has_pic' => 1])->pluck('id')->toArray(),
            "statuses" => StatusItemModel::whereIn('id', [1, 2])->get() // only take status aktif & non aktif
        ];

        return view('pages/backoffice/item/add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "category_id" => "required",
            "status_id" => "required",
            "code" => "required",
            "register_number" => "required",
            "name" => "required",
            "year" => "required",
            "owner_name" => "required"
        ]);
        
        $category = CategoryItemModel::find($request->category_id);
        $current_items_by_category = ItemModel::where(['category_id' => $category->id, 'is_deleted' => 0, 'current_status_id' => 1])->count();

        if($current_items_by_category >= $category->max){
            Alert::error('Gagal!', 'Barang pada kategori ini telah melebihi kuota!');
            return redirect()->back()->withInput();
        }

        $new_id = (string) Str::uuid();
        $new_data = [
            "id" => $new_id,
            "category_id" => $request->category_id,
            "current_status_id" => $request->status_id,
            "code" => $request->code,
            "register_number" => $request->register_number,
            "name" => $request->name,
            "year" => $request->year,
            "owner_name" => $request->owner_name
        ];

        if($request->pic_name){
            $new_data['pic_name'] = $request->pic_name;
        }
        
        $path = '/public/uploads/images/items/' . $new_id . '/';

        if($request->img_file){
            $file_name = $request->img_file->getClientOriginalName();
            $request->img_file->storeAs($path, $file_name);
            $new_data['img_filename'] = $file_name;
        }

        $new_data = ItemModel::create($new_data);

        if($new_data->exists){
            Alert::success('Berhasil!', 'Data barang berhasil ditambahkan!');
            return redirect('/backoffice/item');
        }
    }

    public function edit($id)
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "used",
            "categories" => CategoryItemModel::where(['is_deleted' => 0])->get(),
            "category_has_pic_ids" => CategoryItemModel::where(['is_deleted' => 0, 'is_has_pic' => 1])->pluck('id')->toArray(),
            "statuses" => StatusItemModel::whereIn('id', [1, 2])->get(), // only take status aktif & non aktif
            "path_image" =>  "/backoffice/show-file/images/items/",
            "data" => ItemModel::find($id)
        ];

        return view('pages/backoffice/item/edit', $data);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            "category_id" => "required",
            "status_id" => "required",
            "code" => "required",
            "register_number" => "required",
            "name" => "required",
            "year" => "required",
            "owner_name" => "required"
        ]);
        
        $category = CategoryItemModel::find($request->category_id);
        $current_items_by_category = ItemModel::where(['category_id' => $category->id, 'is_deleted' => 0, 'current_status_id' => 1])->count();

        if($current_items_by_category >= $category->max){
            Alert::error('Gagal!', 'Barang pada kategori ini telah melebihi kuota!');
            return redirect()->back()->withInput();
        }

        $data = ItemModel::find($request->id);

        $new_data_Obj = [
            "category_id" => $request->category_id,
            "current_status_id" => $request->status_id,
            "code" => $request->code,
            "register_number" => $request->register_number,
            "name" => $request->name,
            "year" => $request->year,
            "owner_name" => $request->owner_name
        ];

        if($request->pic_name){
            $new_data_Obj['pic_name'] = $request->pic_name;
        }
        
        $path = '/public/uploads/images/items/'. $request->id . '/';;
        if($request->img_file){
            Storage::delete($path . $data->img_filename);

            $file_name = $request->img_file->getClientOriginalName();
            $request->img_file->storeAs($path, $file_name);
            $new_data_Obj['img_filename'] = $file_name;
        }

        $updated_data = $data->update($new_data_Obj);

        if($updated_data){
            Alert::success('Berhasil!', 'Data barang berhasil diedit!');
            return redirect('/backoffice/item');
        }
    }
    
    public function delete(Request $request)
    {
        //soft delete
        $deleted_repository_item = RepositoryItemModel::where(['item_id' => $request->id])->update(['is_deleted' => 1]);
        $deleted_data = ItemModel::find($request->id)->update(['current_repository_id' => null, 'is_deleted' => 1]);

        if($deleted_data){
            Alert::success('Berhasil!', 'Data barang berhasil dihapus!');
            return redirect('/backoffice/item');
        }
    }

    public function generateQRCode($id)
    {
        $item = ItemModel::findOrFail($id);
        $qrcode = QrCode::size(400)->generate(json_encode(['id' => $item->id]));

        $data = [
            'item' => $item,
            'qrcode' => (string) $qrcode
        ];

        $data = json_encode($data);

        return $data;
    }

}
