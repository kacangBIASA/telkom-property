<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wilayah', function (Blueprint $t) {
            $t->id();
            $t->string('nama_wilayah');
            $t->string('kabupaten');
            $t->timestamps();
        });

        Schema::create('aset', function (Blueprint $t) {
            $t->id();
            $t->foreignId('wilayah_id')->constrained('wilayah');
            $t->string('kode_aset')->unique();
            $t->string('nama_aset');
            $t->enum('jenis', ['gedung', 'lahan']);
            $t->string('alamat')->nullable();
            $t->decimal('luas_tanah', 12, 2);
            $t->decimal('luas_gedung', 12, 2)->default(0);
            $t->decimal('space_idle_gedung', 12, 2)->default(0);
            $t->decimal('luas_lahan_idle', 12, 2)->default(0);
            $t->decimal('lebar_jalan', 8, 2); // C2 aksesibilitas
            $t->enum('status_utilisasi', ['kosong', 'sebagian', 'terpakai']);
            $t->string('potensi_pengembangan')->nullable();
            $t->text('keterangan')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });

        Schema::create('kriteria', function (Blueprint $t) {
            $t->id();
            $t->string('kode')->unique();
            $t->string('nama');
            $t->enum('tipe', ['benefit', 'cost']);
            $t->string('satuan');
            $t->timestamps();
        });

        Schema::create('perhitungan', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained();
            $t->string('judul');
            $t->string('filter_jenis')->nullable();
            $t->foreignId('filter_wilayah_id')->nullable()->constrained('wilayah');
            $t->unsignedInteger('jumlah_alternatif');
            $t->timestamps();
        });

        Schema::create('perhitungan_bobot', function (Blueprint $t) {
            $t->id();
            $t->foreignId('perhitungan_id')->constrained('perhitungan')->cascadeOnDelete();
            $t->foreignId('kriteria_id')->constrained('kriteria');
            $t->string('tipe');
            $t->decimal('entropy', 12, 6);
            $t->decimal('diversifikasi', 12, 6);
            $t->decimal('bobot', 12, 6);
        });

        Schema::create('perhitungan_detail', function (Blueprint $t) {
            $t->id();
            $t->foreignId('perhitungan_id')->constrained('perhitungan')->cascadeOnDelete();
            $t->foreignId('aset_id')->constrained('aset');
            $t->foreignId('kriteria_id')->constrained('kriteria');
            $t->decimal('nilai_awal', 12, 6);
            $t->decimal('nilai_normal_entropy', 12, 6);
            $t->decimal('nilai_normal_saw', 12, 6);
        });

        Schema::create('perhitungan_hasil', function (Blueprint $t) {
            $t->id();
            $t->foreignId('perhitungan_id')->constrained('perhitungan')->cascadeOnDelete();
            $t->foreignId('aset_id')->constrained('aset');
            $t->decimal('nilai_preferensi', 12, 6);
            $t->unsignedInteger('peringkat');
        });
    }

    public function down(): void
    {
        foreach (['perhitungan_hasil', 'perhitungan_detail', 'perhitungan_bobot', 'perhitungan', 'kriteria', 'aset', 'wilayah'] as $n) {
            Schema::dropIfExists($n);
        }
    }
};
