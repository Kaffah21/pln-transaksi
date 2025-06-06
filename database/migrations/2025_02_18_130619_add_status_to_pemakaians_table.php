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
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->string('Status')->default('Belum Bayar')->after('BiayaPemakaian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->dropColumn('Status');
        });
    }
};
