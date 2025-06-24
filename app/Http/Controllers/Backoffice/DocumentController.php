<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "document",
            "sub_page_name" => "",
            "data" => DocumentModel::where(['is_deleted' => 0])->get()
        ];

        return view('pages/backoffice/document/index', $data);
    }

    public function create()
    {
        $data = [
            "page_name" => "document",
            "sub_page_name" => ""
        ];

        return view('pages/backoffice/document/add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "description" => "required",
            "file" => "required"
        ]);

        $new_id = (string) Str::uuid();

        $new_data = [
            "id" => $new_id,
            "description" => $request->description
        ];

        $path = '/public/uploads/files/documents/'. $new_id . '/';
        if($request->file){
            $file_name = $request->file->getClientOriginalName();
            $request->file->storeAs($path, $file_name);

            $new_data['file_name'] = $file_name;
        }

        $new_data = DocumentModel::create($new_data);

        if($new_data->exists){
            Alert::success('Berhasil!', 'Data Dokumen Standarisasi ditambahkan!');
            return redirect('/backoffice/document');
        }
    }

    public function edit($id)
    {
        $data = [
            "page_name" => "document",
            "sub_page_name" => "",
            "path_file" =>  "/backoffice/show-file/files/documents/",
            "data" => DocumentModel::find($id),
        ];

        return view('pages/backoffice/document/edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            "description" => "required",
            "file" => "required"
        ]);

        $data = DocumentModel::find($request->id);

        $new_data_Obj = [
            "description" => $request->description
        ];

        $path = '/public/uploads/files/documents/' . $request->id . '/';

        if($request->file){
            Storage::delete($path . $data->file_name);

            $file_name = $request->file->getClientOriginalName();
            $request->file->storeAs($path, $file_name);
            $new_data_Obj['file_name'] = $file_name;
        }

        $updated_data = $data->update($new_data_Obj);

        if($updated_data){
            Alert::success('Berhasil!', 'Data Dokumen Standarisasi berhasil diedit!');
            return redirect('/backoffice/document');
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $deleted_data = DocumentModel::find($request->id)->update(['is_deleted' => 1]);

        if($deleted_data){
            Alert::success('Berhasil!', 'Data Dokumen Standarisasi berhasil dihapus!');
            return redirect('/backoffice/document');
        }
    }
}
