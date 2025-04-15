<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $primaryKey = 'NoKontrol';

    // Jika tidak menggunakan auto-increment, tambahkan ini
    public $incrementing = false;

    protected $fillable = [
        'NoKontrol',
        'Nama',
        'Alamat',
        'Telepon',
        'Jenis_Plg',
    ];

    public function generateNoKontrol()
    {
        
    }
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'Jenis_Plg', 'Jenis_Plg');
    }
}
