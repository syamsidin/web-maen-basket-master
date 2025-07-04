<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\CategoryItemModel;
use App\Models\FieldModel;
use App\Models\ItemConditionModel;
use App\Models\ItemImageModel;
use App\Models\ItemModel;
use App\Models\ItemOriginModel;
use App\Models\ItemUnitModel;
use App\Models\RepositoryItemModel;
use App\Models\StatusItemModel;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index()
    {
        $all_item = ItemModel::where(['is_deleted' => 0])->get();

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
            "fields" => FieldModel::where(['is_deleted' => 0])->get(),
            "item_units" => ItemUnitModel::where(['is_deleted' => 0])->get(),
            "item_origins" => ItemOriginModel::where(['is_deleted' => 0])->get(),
            "item_conditions" => ItemConditionModel::where(['is_deleted' => 0])->get(),
        ];

        return view('pages/backoffice/item/add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "item_id" => "required",
            "item_origin_id" => "required",
            "item_condition_id" => "required",
            "item_unit_id" => "required",
            "entry_year" => "required",
            "entry_date" => "required",
            "price" => "required",
            "qty" => "required",
            "popular_name" => "required"
        ]);

        $new_id = (string) Str::uuid();
        $regist_number = $this->generateRegistrationNumber();

        $new_data = [
            "id" => $new_id,
            "sub_sub_category_item_id" => $request->item_id,
            "item_origin_id" => $request->item_origin_id,
            "item_condition_id" => $request->item_condition_id,
            "item_unit_id" => $request->item_unit_id,
            "entry_year" => $request->entry_year,
            "entry_date" => $request->entry_date,
            "price" => $request->price,
            "qty" => $request->qty,
            "popular_name" => $request->popular_name,
            "registration_number" => $regist_number
        ];

        if ($request->pic_name) {
            $new_data['pic_name'] = $request->pic_name;
        }

        if ($request->holder_name) {
            $new_data['holder_name'] = $request->holder_name;
        }

        $new_data = ItemModel::create($new_data);

        $path = '/public/uploads/images/items/' . $new_id . '/';
        if ($request->img_file) {
            $list_files = $request->img_file;
            $list_files_desc = $request->img_desc;
            foreach ($list_files as $idx => $file) {
                $file_name = $file->getClientOriginalName();
                $file->storeAs($path, $file_name);

                $new_id_img = (string) Str::uuid();
                ItemImageModel::create([
                    'id' => $new_id_img,
                    'item_id' => $new_id,
                    'file_name' => $file_name,
                    'description' => $list_files_desc[$idx]
                ]);
            }
        }

        if ($new_data->exists) {
            Alert::success('Berhasil!', 'Data barang berhasil ditambahkan!');
            return redirect('/backoffice/item');
        }
    }

    public function edit($id)
    {
        $data = [
            "page_name" => "item",
            "sub_page_name" => "used",
            "fields" => FieldModel::where(['is_deleted' => 0])->get(),
            "item_units" => ItemUnitModel::where(['is_deleted' => 0])->get(),
            "item_origins" => ItemOriginModel::where(['is_deleted' => 0])->get(),
            "item_conditions" => ItemConditionModel::where(['is_deleted' => 0])->get(),
            "path_image" =>  "/backoffice/show-file/images/items/",
            "data" => ItemModel::find($id)
        ];

        $data['field_name'] = $data['data']->sub_sub_category_item->sub_sub_category->sub_category->category->field->name;

        return view('pages/backoffice/item/edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            "item_id" => "required",
            "item_origin_id" => "required",
            "item_condition_id" => "required",
            "item_unit_id" => "required",
            "entry_year" => "required",
            "entry_date" => "required",
            "price" => "required",
            "qty" => "required",
            "popular_name" => "required"
        ]);

        $data = ItemModel::find($request->id);

        $new_data_Obj = [
            "sub_sub_category_item_id" => $request->item_id,
            "item_origin_id" => $request->item_origin_id,
            "item_condition_id" => $request->item_condition_id,
            "item_unit_id" => $request->item_unit_id,
            "entry_year" => $request->entry_year,
            "entry_date" => $request->entry_date,
            "price" => $request->price,
            "qty" => $request->qty,
            "popular_name" => $request->popular_name
        ];

        if ($request->pic_name) {
            $new_data_Obj['pic_name'] = $request->pic_name;
        }

        if ($request->holder_name) {
            $new_data_Obj['holder_name'] = $request->holder_name;
        }


        $path = '/public/uploads/images/items/' . $request->id . '/';;

        $exist_items = ItemImageModel::where(['item_id' => $request->id])->pluck('id')->toArray();
        $req_items = [];
        if ($request->img_file_exist_id) {
            $req_items = $request->img_file_exist_id;
        }
        $deleted_items = array_diff($exist_items, $req_items);

        $list_files = $request->img_file;
        $list_files_desc = $request->img_desc;

        foreach ($deleted_items as $item_id) {
            $item = ItemImageModel::find($item_id);
            Storage::delete($path . $item->file_name);
            ItemImageModel::find($item->id)->delete();
        }

        if ($list_files != null) {
            foreach ($list_files as $idx => $file) {
                $file_name = $file->getClientOriginalName();
                $file->storeAs($path, $file_name);

                $new_id_img = (string) Str::uuid();
                ItemImageModel::create([
                    'id' => $new_id_img,
                    'item_id' => $request->id,
                    'file_name' => $file_name,
                    'description' => $list_files_desc[$idx]
                ]);
            }
        }

        $updated_data = $data->update($new_data_Obj);

        if ($updated_data) {
            Alert::success('Berhasil!', 'Data barang berhasil diedit!');
            return redirect('/backoffice/item');
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $deleted_repository_item = RepositoryItemModel::where(['item_id' => $request->id])->update(['is_deleted' => 1]);
        $deleted_data = ItemModel::find($request->id)->update(['current_repository_id' => null, 'is_deleted' => 1]);

        if ($deleted_data) {
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


    public function generateRegistrationNumber()
    {
        $year = date('Y');
        $month = date('m');

        $number = ItemModel::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;
        $number = str_pad($number, 4, '0', STR_PAD_LEFT);

        return $year . $month . $number;
    }

    public function getBulkQRCodes(Request $request)
    {
        $ids = $request->input('ids', []);

        $items = ItemModel::whereIn('id', $ids)->get();

        $qrList = $items->map(function ($item) {
            $data = (string) QrCode::size(400)->generate(url('/item/' . $item->id));
            // $data = (string) QrCode::size(400)->generate(json_encode(['id' => $item->id]));
            return [
                'id' => $item->id,
                'code' => $item->sub_sub_category_item->code,
                'name' => $item->sub_sub_category_item->name,
                'popular_name' => $item->popular_name,
                'data' => $data
            ];
        });

        return response()->json(['data' => $qrList]);
    }
}
