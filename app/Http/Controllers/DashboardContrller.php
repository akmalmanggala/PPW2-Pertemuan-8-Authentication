<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardContrller extends Controller
{
    public function dashboardUser(){
        return view('user.dashboard');
    }

    public function dashboardAdmin(){
        return view('admin.dashboard');
    }
}
