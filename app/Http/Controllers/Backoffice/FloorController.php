<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\FloorImageModel;
use App\Models\FloorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class FloorController extends Controller
{
    public function index()
    {
        $all_floors = FloorModel::where(['is_deleted' => 0])->orderBy('code')->get();

        $data = [
            "page_name" => "repository",
            "sub_page_name" => "floor",
            "data" => $all_floors
        ];

        return view('pages/backoffice/floor/index', $data);
    }
    
    public function edit($id)
    {
        $data = [
            "page_name" => "repository",
            "sub_page_name" => "floor",
            "data" => FloorModel::find($id),
            "path_image" =>  "/backoffice/show-file/images/floors/"
        ];

        return view('pages/backoffice/floor/edit', $data);
    }
    
    public function update(Request $request)
    {
        $path = '/public/uploads/images/floors/'. $request->id . '/';;
        
        $exist_items = FloorImageModel::where(['floor_id' => $request->id])->pluck('id')->toArray();
        $req_items = [];
        if($request->img_file_exist_id){
            $req_items = $request->img_file_exist_id;
        }
        $deleted_items = array_diff($exist_items, $req_items);

        $list_files = $request->img_file;
        $list_files_desc = $request->img_desc;
        
        foreach($deleted_items as $floor_id){
            $item = FloorImageModel::find($floor_id);
            Storage::delete($path . $item->file_name);
            FloorImageModel::find($item->id)->delete();
        }

        foreach($list_files as $idx=>$file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs($path, $file_name);

            $new_id_img = (string) Str::uuid();
            FloorImageModel::create([
                'id' => $new_id_img,
                'floor_id' => $request->id,
                'file_name' => $file_name,
                'description' => $list_files_desc[$idx]
            ]);
        }

        Alert::success('Berhasil!', 'Data lantai berhasil diedit!');
        return redirect('/backoffice/floor');
    }
}
