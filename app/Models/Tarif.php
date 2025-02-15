<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarif extends Model
{
    use HasFactory;
    protected $fillable = ['Jenis_Plg','BiayaBeban','TarifKWH'];

    public function pelanggans()
{
    return $this->hasMany(Pelanggan::class, 'Jenis_Plg', 'Jenis_Plg');
}
}
