<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $kolom = ['status_tanah', 'penggunaan_saat_ini', 'peruntukan', 'properti_sekitar', 'jarak_pusat_kota',
        'bentuk_lahan', 'lebar_lahan', 'kedalaman_lahan', 'kondisi_lahan', 'titik_koordinat', 'fasilitas'];

    public function up(): void
    {
        Schema::table('aset', function (Blueprint $t) {
            foreach ($this->kolom as $k) {
                $t->string($k)->nullable();
            }
        });
        Schema::create('aset_gambar', function (Blueprint $t) {
            $t->id();
            $t->foreignId('aset_id')->constrained('aset')->cascadeOnDelete();
            $t->string('path');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_gambar');
        Schema::table('aset', fn (Blueprint $t) => $t->dropColumn($this->kolom));
    }
};
