<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\Kriteria;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin dibuat lewat seeder (tidak ada pendaftaran).
        User::updateOrCreate(['email' => 'admin@telkomproperty.test'], [
            'name' => 'Admin Aset', 'username' => 'admin', 'password' => Hash::make('password'),
        ]);

        Kriteria::insert([
            ['kode' => 'C1', 'nama' => 'Luas ruang idle', 'tipe' => 'benefit', 'satuan' => 'm²'],
            ['kode' => 'C2', 'nama' => 'Aksesibilitas lokasi (lebar jalan)', 'tipe' => 'benefit', 'satuan' => 'm'],
        ]);

        $wilayah = collect([['Jember', 'Jember'], ['Tanggul', 'Jember'], ['Takos Jember', 'Jember']])
            ->mapWithKeys(fn ($w) => [$w[0] => Wilayah::create(['nama_wilayah' => $w[0], 'kabupaten' => $w[1]])]);

        // 17 aset sampel proposal (Tabel 4.2-4.4). Sumber: Profil Aset Area Jatim Timur.
        // [wilayah, kode, nama, alamat, jenis, tanah, gedung, idle (C1), jalan (C2), status, status_tanah, penggunaan, peruntukan, jarak km, potensi, keterangan]
        $rows = [
            ['Jember', 'JBR-001', 'Gedung Ex TTC Jember', 'Jl. Imam Bonjol No. 57, Kaliwates', 'gedung', 2453.14, 1896.12, 1896.12, 8, 'kosong', 'HGB 30', 'Gedung kosong', 'Kantor komersial, sekolah', 3, 'Perkantoran, retail, café, sekolah', 'Space idle tidak tertulis pada sumber; ditetapkan sama dengan luas gedung karena gedung kosong (asumsi, perlu konfirmasi perusahaan).'],
            ['Jember', 'JBR-002', 'STO Sukowono', 'Jl. Trunojoyo, Sukowono', 'gedung', 600, 150, 57.65, 10, 'sebagian', 'Hak Pakai', null, 'Retail, ATM, perkantoran', 23, 'ATM, retail, perkantoran', null],
            ['Jember', 'JBR-003', 'STO Sempolan', 'Jl. Raya Sempolan', 'gedung', 520, 156, 63, 10, 'sebagian', 'Hak Pakai', 'Telkom', 'ATM', 20, 'ATM, mini café, komersil', null],
            ['Jember', 'JBR-004', 'STO Kalisat', 'Jl. HOS Cokroaminoto, Kalisat', 'gedung', 1128, 300, 73.92, 6, 'sebagian', 'Hak Pakai', 'Telkom', 'ATM', 15, 'ATM, mini café, komersil', null],
            ['Jember', 'JBR-005', 'STO Arjasa', 'Jl. Sultan Agung, Arjasa', 'gedung', 2954, 263, 79, 16, 'sebagian', 'Hak Pakai', 'Perangkat', 'Retail, perkantoran', 8, 'ATM, retail, perkantoran', null],
            ['Jember', 'JBR-006', 'STO 2 Jember (Infratel Jember)', 'Jl. Letjen Suprapto No. 65', 'gedung', 1571, 518, 59.85, 10, 'sebagian', 'HGB No. 1465/1995', 'Kantor pelayanan', 'Kantor komersial', 4, 'Retail, ATM', null],
            // Sumber menulis FULL pada kolom idle: dibaca terisi penuh, jadi idle 0 dan tidak menjadi alternatif.
            ['Jember', 'JBR-007', 'STO 1 Jember', 'Jl. HOS Cokroaminoto No. 25', 'gedung', 4287, 1753, 0, 15, 'terpakai', 'Hak Penggunaan', 'Gedung perangkat', 'Kantor komersial', 3, 'ATM, mini café, perkantoran', 'Space idle pada sumber tertulis FULL; dibaca terisi penuh (asumsi, perlu konfirmasi perusahaan).'],
            ['Jember', 'JBR-008', 'Plasa Telkom Jember (Witel)', 'Jl. Gajah Mada No. 182-184', 'gedung', 9954, 11088, 4752.29, 20, 'sebagian', 'Hak Milik', 'Plasa Telkom, kantor', 'Kantor komersial', 2, 'ATM, mini café, perkantoran', null],
            ['Tanggul', 'TGL-001', 'STO Tanggul', 'Jl. Raung No. 7, Tanggul', 'gedung', 1299, 440, 15, 5, 'sebagian', null, 'Telkom', null, 30, 'ATM, retail, komersial', null],
            ['Tanggul', 'TGL-002', 'STO Rambipuji', 'Jl. Mangun Sarkoro No. 20, Rambipuji', 'gedung', 778, 328, 45, 5, 'sebagian', null, 'Telkom', null, 12, 'ATM, retail, komersial', null],
            ['Tanggul', 'TGL-003', 'STO Puger', 'Jl. Raya Puger', 'gedung', 1283, 192, 80, 10, 'sebagian', null, 'Telkom', null, 36, 'ATM, retail, komersial', null],
            ['Tanggul', 'TGL-004', 'STO Jenggawah', 'Jl. A. Yani No. 42, Jenggawah', 'gedung', 820, 171, 15, 10, 'sebagian', null, 'Telkom', null, 10, 'ATM, mini kafe, komersial', null],
            ['Tanggul', 'TGL-005', 'STO Kencong', 'Jl. Diponegoro No. 55, Kencong', 'gedung', 880, 197, 54, 6, 'sebagian', null, 'Telkom', null, 45, 'ATM, retail, komersial', null],
            ['Tanggul', 'TGL-006', 'STO Balung', 'Jl. Raya Rambipuji No. 2, Balung', 'gedung', 464, 276, 25, 8, 'sebagian', null, 'Telkom', null, 23, 'ATM, retail, komersial', null],
            ['Tanggul', 'TGL-007', 'STO Ambulu', 'Jl. A. Yani, Ambulu', 'gedung', 972, 275, 60, 6, 'sebagian', null, 'Telkom', null, 27, 'ATM, retail, komersial', null],
            ['Takos Jember', 'TKS-001', 'Takos Pace', 'Dusun Pace, Silo', 'lahan', 1000, 16, 977, 3, 'kosong', null, 'STO Telkom dan lahan kosong', null, 39, 'Retail, toko bangunan', 'Luas tanah ±1.000 m² menurut sumber.'],
            ['Takos Jember', 'TKS-002', 'Takos Sumberbulus', 'Jl. Cumedak 182-184, Ledokombo', 'lahan', 585, 25, 585, 6, 'kosong', null, 'STO Telkom dan lahan kosong', null, 27.3, 'Retail, toko bangunan', null],
        ];
        foreach ($rows as [$wil, $kode, $nama, $alamat, $jenis, $tanah, $gedung, $idle, $jalan, $status, $st, $pakai, $untuk, $jarak, $potensi, $ket]) {
            Aset::create([
                'wilayah_id' => $wilayah[$wil]->id, 'kode_aset' => $kode, 'nama_aset' => $nama, 'alamat' => $alamat, 'jenis' => $jenis,
                'luas_tanah' => $tanah, 'luas_gedung' => $gedung, 'lebar_jalan' => $jalan, 'status_utilisasi' => $status,
                'space_idle_gedung' => $jenis === 'gedung' ? $idle : 0, 'luas_lahan_idle' => $jenis === 'lahan' ? $idle : 0,
                'status_tanah' => $st, 'penggunaan_saat_ini' => $pakai, 'peruntukan' => $untuk,
                'jarak_pusat_kota' => $jarak.' km', 'potensi_pengembangan' => $potensi, 'keterangan' => $ket,
            ]);
        }
    }
}
