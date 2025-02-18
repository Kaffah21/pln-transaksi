<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemakaian extends Model
{
    use HasFactory;
    protected $fillable = [
        'Tahun',
        'Bulan',
        'NoKontrol',
        'MeterAwal',
        'MeterAkhir',
        'JumlahPakai',
        'BiayaBebanPemakai',
        'BiayaPemakaian',
        'Status'
    ];
}
