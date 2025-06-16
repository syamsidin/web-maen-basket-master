<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\CategoryItemModel;
use App\Models\ItemModel;
use App\Models\RepositoryItemModel;
use App\Models\StatusItemModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NotUsedItemController extends Controller
{
    public function index()
    {
        $all_item = ItemModel::with('status')->where('current_status_id', '!=' , 1)->where(['is_deleted' => 0])->get();
        foreach($all_item as $item){
            // $item['qrcode'] = (string) QrCode::size(400)->generate(json_encode(['id' => $item->id]));
            $item['qrcode'] = (string) QrCode::size(400)->generate(url('/item/' . $item->id));
        }

        // dd($all_item);

        $data = [
            "page_name" => "item",
            "sub_page_name" => "not_used",
            "data" => $all_item
        ];

        return view('pages/backoffice/not_used_item/index', $data);
    }

    public function edit($id)
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "not_used",
            "categories" => CategoryItemModel::where(['is_deleted' => 0])->get(),
            "category_has_pic_ids" => CategoryItemModel::where(['is_deleted' => 0, 'is_has_pic' => 1])->pluck('id')->toArray(),
            "statuses" => StatusItemModel::whereNotIn('id', [1])->get(), // only take status aktif & non aktif
            "data" => ItemModel::find($id)
        ];

        return view('pages/backoffice/not_used_item/edit', $data);
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

        if($request->damage_description){
            $new_data_Obj['damage_description'] = $request->damage_description;
        }

        $updated_data = $data->update($new_data_Obj);

        if($updated_data){
            Alert::success('Berhasil!', 'Data barang tak terpakai berhasil diedit!');
            return redirect('/backoffice/not-used-item');
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $deleted_repository_item = RepositoryItemModel::where(['item_id' => $request->id])->update(['is_deleted' => 1]);
        $deleted_data = ItemModel::find($request->id)->update(['current_repository_id' => null, 'is_deleted' => 1]);

        if($deleted_data){
            Alert::success('Berhasil!', 'Data barang tak terpakai berhasil dihapus!');
            return redirect('/backoffice/not-used-item');
        }
    }
}
