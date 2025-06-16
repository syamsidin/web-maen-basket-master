<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\ItemModel;
use App\Models\RepositoryItemModel;
use App\Models\RepositoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RepositoryController extends Controller
{
    public function index()
    {
        $all_repository = RepositoryModel::where(['is_deleted' => 0])->get();
        foreach($all_repository as $repository){
            $repository['qrcode'] = (string) QrCode::size(400)->generate(url('/repository/' . $repository->id));
        }

        $data = [
            "page_name" => "repository",
            "sub_page_name" => "",
            "data" => $all_repository
        ];

        return view('pages/backoffice/repository/index', $data);
    }

    public function create()
    {
        $data = [
            "page_name" => "repository",
            "sub_page_name" => "",
            "items" => ItemModel::where(['current_repository_id' => null, 'is_deleted' => 0])->orderBy('code')->get()
        ];

        return view('pages/backoffice/repository/add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "code" => "required",
            "list_item" => "required",
        ]);

        $new_id = (string) Str::uuid();

        $new_data = [
            "id" => $new_id,
            "code" => $request->code
        ];
        
        $path = '/public/uploads/images/repositories/' . $new_id . '/';

        if($request->img_file){
            $file_name = $request->img_file->getClientOriginalName();
            $request->img_file->storeAs($path, $file_name);
            $new_data['img_filename'] = $file_name;
        }

        $new_data = RepositoryModel::create($new_data);

        foreach($request->list_item as $item){
            ItemModel::find($item)->update(['current_repository_id' => $new_id]);
            RepositoryItemModel::create([
                'repository_id' => $new_id,
                'item_id' => $item
            ]);
        }

        if($new_data->exists){
            Alert::success('Berhasil!', 'Data ruangan berhasil ditambahkan!');
            return redirect('/backoffice/repository');
        }
    }

    
    public function edit($id)
    {
        $data = [
            "page_name" => "repository",
            "sub_page_name" => "",
            "data" => RepositoryModel::find($id),
            "repository_item_ids" => ItemModel::where(['current_repository_id' => $id, 'is_deleted' => 0])->pluck('id')->toArray(),
            "path_image" =>  "/backoffice/show-file/images/repositories/",
            "items" => ItemModel::where(function ($query) use ($id) {
                            $query->where('current_repository_id', '=', null)
                                ->orWhere('current_repository_id', '=', $id);
                        })->where(['is_deleted' => 0])->orderBy('code')->get()
        ];

        return view('pages/backoffice/repository/edit', $data);
    }

    
    
    public function update(Request $request)
    {
        $request->validate([
            "code" => "required",
            "list_item" => "required",
        ]);

        $data = RepositoryModel::find($request->id);

        $new_data_Obj = [
            "code" => $request->code

        ];

        $path = '/public/uploads/images/repositories/' . $request->id . '/';

        if($request->img_file){
            Storage::delete($path . $data->img_filename);

            $file_name = $request->img_file->getClientOriginalName();
            $request->img_file->storeAs($path, $file_name);
            $new_data_Obj['img_filename'] = $file_name;
        }

        $updated_data = $data->update($new_data_Obj);
        
        $exist_items = RepositoryItemModel::where(['repository_id' => $request->id, 'is_deleted' => 0])->pluck('item_id')->toArray();
        $deleted_items = array_diff($exist_items, $request->list_item);
        $new_items = array_diff($request->list_item, $exist_items);

        foreach($deleted_items as $item){
            ItemModel::find($item)->update(['current_repository_id' => null]);
            RepositoryItemModel::where(['repository_id' => $request->id, 'item_id' => $item, 'is_deleted' => 0])->update(['is_deleted' => 1]);
        }

        foreach($new_items as $item){
            ItemModel::find($item)->update(['current_repository_id' => $request->id]);
            RepositoryItemModel::create([
                'repository_id' => $request->id,
                'item_id' => $item
            ]);
        }

        if($updated_data){
            Alert::success('Berhasil!', 'Data ruangan berhasil diedit!');
            return redirect('/backoffice/repository');
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $deleted_repository_item = RepositoryItemModel::where(['repository_id' => $request->id])->update(['is_deleted' => 1]);
        $deleted_item = ItemModel::where(['current_repository_id' => $request->id])->update(['current_repository_id' => null]);
        $deleted_data = RepositoryModel::find($request->id)->update(['is_deleted' => 1]);

        if($deleted_data){
            Alert::success('Berhasil!', 'Data ruangan berhasil dihapus!');
            return redirect('/backoffice/repository');
        }
    }
}
