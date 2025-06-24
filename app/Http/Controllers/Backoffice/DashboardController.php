<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemModel;
use App\Models\RepositoryModel;
use App\Models\BuildingModel;

class DashboardController extends Controller
{
    public function index()
    {
        $summary = [
            "item" => ItemModel::where(['is_deleted' => 0])->count(),
            "repository" => RepositoryModel::where(['is_deleted' => 0])->count(),
            "building" => BuildingModel::where(['is_deleted' => 0])->count(),
        ];

        $chart_data = $this->chart_data();

        $data = [
            "page_name" => "dashboard",
            "sub_page_name" => "",
            "summary" => $summary,
            "chart_data" => $chart_data
        ];

        return view('pages/backoffice/dashboard/index', $data);
    }

    private function chart_data(){
        $current_date = date('Y');
        $label = [];

        for($idx = 1; $idx <= 5; $idx++){
            array_unshift($label, $current_date);

            $date = $current_date - $idx;
            $current_date = $date;
        }

        $data = [
            'label' => $label
        ];

        // dd($data);
        return $data;
    }
}
