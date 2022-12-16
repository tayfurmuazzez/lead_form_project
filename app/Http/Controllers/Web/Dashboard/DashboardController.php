<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $viewData["userId"] = auth()->user()->id;
        $viewData["isAdmin"] = auth()->user()->hasRole('admin');
        return view('dashboard.index',$viewData);
    }
}
