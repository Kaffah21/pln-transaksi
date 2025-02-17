<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
class DashboardController extends Controller
{
   public function index()
   {
    $totalPelanggans = Pelanggan::count();
    return view('dashboard',compact('totalPelanggans'));
   }
}
