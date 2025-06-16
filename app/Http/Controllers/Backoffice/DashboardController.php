<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "dashboard",
            "sub_page_name" => ""
        ];

        return view('pages/backoffice/dashboard/index', $data);
    }
}
