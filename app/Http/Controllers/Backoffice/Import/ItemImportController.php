<?php

namespace App\Http\Controllers\Backoffice\Import;

use App\Http\Controllers\Controller;
use App\Imports\AllFieldsItemImport;
use App\Imports\ItemDetailImport;
use App\Imports\ItemImport;
use App\Models\CategoryModel;
use App\Models\FieldModel;
use App\Models\SubCategoryModel;
use App\Models\SubSubCategoryItemModel;
use App\Models\SubSubCategoryModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ItemImportController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "import",
            "sub_page_name" => "item"
        ];

        return view('pages/backoffice/item_import/index', $data);
    }

    public function index_category()
    {
        $data = [
            "page_name" => "import",
            "sub_page_name" => "item_category"
        ];

        return view('pages/backoffice/category_item_import/index', $data);
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
        Excel::import(new ItemDetailImport, $file);
 
        Alert::success('Berhasil!', 'Import data barang berhasil!');
        return redirect('/backoffice/import/item');
    }

    public function import_category(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');
 
        // Process the Excel file
        Excel::import(new AllFieldsItemImport, $file);
 
        Alert::success('Berhasil!', 'Import data kategori barang berhasil!');
        return redirect('/backoffice/import/category-item');
    }
}
