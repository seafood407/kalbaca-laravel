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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('umur');
            $table->float('berat_badan');
            $table->float('tinggi_badan')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->float('suhu_tubuh')->nullable();
            $table->float('intake')->nullable();
            $table->float('output')->nullable();
            $table->float('persentase_luka_bakar')->nullable();
            $table->text('hasil_perhitungan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
