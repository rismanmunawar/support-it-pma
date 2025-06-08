<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'SITI RAHMAWATI',
                'email' => 'siti.rahmawati@pinusmerahabadi.co.id',
                'phone' => '+62 812-3456-7890',
                'nik' => '10000001',
                'branch' => '-'
            ],
            [
                'name' => 'AHMAD FAUZAN',
                'email' => 'ahmad.fauzan@pinusmerahabadi.co.id',
                'phone' => '+62 813-2345-6789',
                'nik' => '10000002',
                'branch' => '-'
            ],
            [
                'name' => 'LINA MAHARANI',
                'email' => 'lina.maharani@pinusmerahabadi.co.id',
                'phone' => '+62 814-5678-1234',
                'nik' => '10000003',
                'branch' => '-'
            ],
            [
                'name' => 'BUDI SANTOSO',
                'email' => 'budi.santoso@pinusmerahabadi.co.id',
                'phone' => '+62 815-6789-2345',
                'nik' => '10000004',
                'branch' => '-'
            ],
            [
                'name' => 'DEWI KURNIA',
                'email' => 'dewi.kurnia@pinusmerahabadi.co.id',
                'phone' => '+62 816-7890-3456',
                'nik' => '10000005',
                'branch' => '-'
            ],
            [
                'name' => 'RIZKY PRATAMA',
                'email' => 'rizky.pratama@pinusmerahabadi.co.id',
                'phone' => '+62 817-8901-4567',
                'nik' => '10000006',
                'branch' => '-'
            ],
            [
                'name' => 'FITRI NOVITA',
                'email' => 'fitri.novita@pinusmerahabadi.co.id',
                'phone' => '+62 818-9012-5678',
                'nik' => '10000007',
                'branch' => '-'
            ],
            [
                'name' => 'AGUS WIDODO',
                'email' => 'agus.widodo@pinusmerahabadi.co.id',
                'phone' => '+62 819-0123-6789',
                'nik' => '10000008',
                'branch' => '-'
            ],
            [
                'name' => 'MAYA SARI',
                'email' => 'maya.sari@pinusmerahabadi.co.id',
                'phone' => '+62 820-1234-7890',
                'nik' => '10000009',
                'branch' => '-'
            ],
            [
                'name' => 'HENDRA SETIAWAN',
                'email' => 'hendra.setiawan@pinusmerahabadi.co.id',
                'phone' => '+62 821-2345-8901',
                'nik' => '10000010',
                'branch' => '-'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name'       => $user['name'],
                'email'      => $user['email'],
                'phone'      => $user['phone'],
                'nik'        => $user['nik'],
                'branch'        => $user['branch'],
                'password'   => Hash::make('pma123'), // Password default
                'role'       => 'SA',
                'role_desc'  => 'Sales Admin',
            ]);
        }
    }
}
