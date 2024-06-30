<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mstr_Hospital;
use App\Models\Pasien;

class DashboardController extends Controller
{
    public function dashboard(){
        $mstr_hospital = Mstr_Hospital::count();
        $pasien = Pasien::count();
        return view('admin.dashboard', compact('mstr_hospital','pasien'));
    }
}
