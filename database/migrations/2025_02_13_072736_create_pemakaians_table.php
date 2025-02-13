<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemakaians', function (Blueprint $table) {
            $table->id();
            $table->year('Tahun');
            $table->tinyInteger('Bulan');
            $table->string('NoKontrol');
            $table->integer('MeterAwal');
            $table->integer('MeterAkhir');
            $table->integer('JumlahPakai');
            $table->decimal('BiayaBebanPemakai', 10, 2);
            $table->decimal('BiayaPemakaian', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaians');
    }
};
