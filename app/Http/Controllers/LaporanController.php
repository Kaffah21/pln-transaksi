<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemakaian::join('pelanggans', 'pemakaians.NoKontrol', '=', 'pelanggans.NoKontrol')
            ->select('pemakaians.*', 'pelanggans.Nama', 'pelanggans.Alamat', 'pelanggans.Telepon');
    
        // Filter No Kontrol
        if ($request->filled('no_kontrol')) {
            $query->where('pemakaians.NoKontrol', 'like', '%' . trim($request->no_kontrol) . '%');
        }
    
        // Filter Bulan
        if ($request->filled('bulan')) {
            $query->where('pemakaians.Bulan', $request->bulan);
        }
    
        // Filter Tahun
        if ($request->filled('tahun')) {
            $query->where('pemakaians.Tahun', $request->tahun);
        }
    
        // Filter Status
        if ($request->filled('status')) {
            $query->where('pemakaians.Status', $request->status);
        }
    
        $pemakaians = $query->paginate(10)->appends($request->except('page'));
    
        return view('laporan.list', compact('pemakaians'));
    }
    

    public function exportPdf(Request $request)
    {
        $noKontrol = $request->input('no_kontrol');
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $status = $request->input('status'); // Ambil status dari request
    
        // Query Pemakaian berdasarkan filter yang diterima
        $pemakaians = Pemakaian::when($noKontrol, function ($query, $noKontrol) {
            return $query->where('NoKontrol', 'like', "%{$noKontrol}%");
        })
        ->when($tahun, function ($query, $tahun) {
            return $query->where('Tahun', $tahun);
        })
        ->when($bulan, function ($query, $bulan) {
            return $query->where('Bulan', $bulan);
        })
        ->when($status, function ($query, $status) { // Tambahkan kondisi filter berdasarkan status
            return $query->where('Status', $status);
        })
        ->get();
    
        // Kirim data filter ke PDF view
        $pdf = Pdf::loadView('laporan.eksport-pdf', compact('pemakaians', 'tahun', 'bulan', 'noKontrol', 'status'));
        return $pdf->stream('laporan-pemakaian.pdf');
    }
    
}
