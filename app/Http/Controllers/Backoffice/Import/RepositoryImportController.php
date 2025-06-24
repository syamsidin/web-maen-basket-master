<?php

namespace App\Http\Controllers\Backoffice\Import;

use App\Http\Controllers\Controller;
use App\Imports\AllBuildingRepositoryImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RepositoryImportController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "import",
            "sub_page_name" => "repository"
        ];

        return view('pages/backoffice/repository_import/index', $data);
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');
 
        // Process the Excel file
        Excel::import(new AllBuildingRepositoryImport, $file);
 
        Alert::success('Berhasil!', 'Import data ruangan barang berhasil!');
        return redirect('/backoffice/import/repository');
    }
}
