<?php

namespace App\Http\Controllers\Backoffice\API;

use App\Http\Controllers\Controller;
use App\Models\FloorModel;
use App\Models\RepositoryModel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RepositoryController extends Controller
{
    public function get_floors($building_id)
    {
        $data = FloorModel::where(['building_id' => $building_id])->orderBy('name')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }

    public function get_repositories($floor_id)
    {
        $data = RepositoryModel::where(['floor_id' => $floor_id])->orderBy('name')->get();

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_repository_detail($id)
    {
        $data = RepositoryModel::find($id);

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_qr_code($id)
    {
        $data = (string) QrCode::size(300)->generate(url('/repository/' . $id));

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_qr_code_building($id)
    {
        $data = (string) QrCode::size(300)->generate(url('/building/' . $id));

        return response()->json(['message' => 'success', 'data' => $data]);
    }
    
    public function get_qr_code_floor($id)
    {
        $data = (string) QrCode::size(300)->generate(url('/floor/' . $id));

        return response()->json(['message' => 'success', 'data' => $data]);
    }
}
