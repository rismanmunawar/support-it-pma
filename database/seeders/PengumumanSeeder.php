<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengumuman;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pengumuman::create([
            'user_id'  => 1, // Sesuaikan dengan ID user yang sudah ada
            'judul'    => 'Pemeliharaan Server',
            'isi'      => 'Server akan dipelihara pada hari Jumat pukul 22.00 WIB.',
            'kategori' => 'Informasi',
            // 'gambar'   => 'default.jpg', // Bisa sesuaikan nama file gambarnya
        ]);

        Pengumuman::create([
            'user_id'  => 2,
            'judul'    => 'Libur Nasional',
            'isi'      => 'Kantor akan libur pada tanggal 17 Agustus.',
            'kategori' => 'Pengumuman',
            // 'gambar'   => 'libur.jpg',
        ]);
    }
}
