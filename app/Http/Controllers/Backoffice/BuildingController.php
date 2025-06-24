<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\BuildingImageModel;
use App\Models\BuildingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class BuildingController extends Controller
{
    public function index()
    {
        $all_buildings = BuildingModel::where(['is_deleted' => 0])->orderBy('code')->get();

        $data = [
            "page_name" => "repository",
            "sub_page_name" => "building",
            "data" => $all_buildings
        ];

        return view('pages/backoffice/building/index', $data);
    }
    
    public function edit($id)
    {
        $data = [
            "page_name" => "repository",
            "sub_page_name" => "building",
            "data" => BuildingModel::find($id),
            "path_image" =>  "/backoffice/show-file/images/buildings/"
        ];

        return view('pages/backoffice/building/edit', $data);
    }
    
    public function update(Request $request)
    {
        $path = '/public/uploads/images/buildings/'. $request->id . '/';;
        
        $exist_items = BuildingImageModel::where(['building_id' => $request->id])->pluck('id')->toArray();
        $req_items = [];
        if($request->img_file_exist_id){
            $req_items = $request->img_file_exist_id;
        }
        $deleted_items = array_diff($exist_items, $req_items);

        $list_files = $request->img_file;
        $list_files_desc = $request->img_desc;
        
        foreach($deleted_items as $building_id){
            $item = BuildingImageModel::find($building_id);
            Storage::delete($path . $item->file_name);
            BuildingImageModel::find($item->id)->delete();
        }

        foreach($list_files as $idx=>$file){
            $file_name = $file->getClientOriginalName();
            $file->storeAs($path, $file_name);

            $new_id_img = (string) Str::uuid();
            BuildingImageModel::create([
                'id' => $new_id_img,
                'building_id' => $request->id,
                'file_name' => $file_name,
                'description' => $list_files_desc[$idx]
            ]);
        }

        Alert::success('Berhasil!', 'Data ruangan berhasil diedit!');
        return redirect('/backoffice/building');
    }
}
