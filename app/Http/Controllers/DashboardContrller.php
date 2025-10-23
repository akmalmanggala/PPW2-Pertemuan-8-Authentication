<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardContrller extends Controller
{
    public function dashboardUser(){
        return view('dashboard.user');
    }

    public function dashboardAdmin(){
        return view('dashboard.admin');
    }
}
