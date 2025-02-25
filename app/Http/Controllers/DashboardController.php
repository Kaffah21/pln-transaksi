<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
   public function index()
   {
    $totalPelanggans = Pelanggan::count();
    $totalPemakaian = DB::table('pemakaians')->sum('JumlahPakai');
    $lunas = DB::table('pemakaians')->where('Status','Lunas')->count();
    $belumBayar = DB::table('pemakaians')->where('Status','Belum Bayar')->count();
    return view('dashboard',compact('totalPelanggans','totalPemakaian','lunas','belumBayar'));
   }
}
