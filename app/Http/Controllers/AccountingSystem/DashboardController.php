<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.home.home');
    }
}
