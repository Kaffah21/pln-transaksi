<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $fillable = ['NoKontrol','Nama','Alamat','Telpon','Jenis_Plg'];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'Jenis_Plg');
    }
}
