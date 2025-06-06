<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserITSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'RACHMAD WIBAWA',
                'email' => 'rachmad_wibawa@pinusmerahabadi.co.id',
                'phone' => '+62 856-9311-2392',
                'nik' => '00000000',
            ],
            [
                'name' => 'DEDE MUNAWAR RISMAN',
                'email' => 'pmaho_itsupport7@pinusmerahabadi.co.id',
                'phone' => '+62 813-2100-4608',
                'nik' => '00000007',
            ],
            [
                'name' => 'ADHITIA BISMAR PAMUNGKAS',
                'email' => 'pmaho_itsupport6@pinusmerahabadi.co.id',
                'phone' => '+62 856-9180-6032',
                'nik' => '00000006',
            ],
            [
                'name' => 'EKO ARLANDO SAPUTRA',
                'email' => 'pmaho_itsupport5@pinusmerahabadi.co.id',
                'phone' => '+62 813-8768-6426',
                'nik' => '00000005',
            ],
            [
                'name' => 'AGUS SUPRIADI',
                'email' => 'pmaho_itsupport4@pinusmerahabadi.co.id',
                'phone' => '+62 812-2340-7531',
                'nik' => '00000004',
            ],
            [
                'name' => 'MUHAMMAD HERLANGGA',
                'email' => 'pmaho_itsupport3@pinusmerahabadi.co.id',
                'phone' => '+62 858-6014-7336',
                'nik' => '00000003',
            ],
            [
                'name' => 'NANDA ADANG KHUMAENI',
                'email' => 'pmaho_itsupport2@pinusmerahabadi.co.id',
                'phone' => '+62 896-3052-5898',
                'nik' => '00000002',
            ],
            [
                'name' => 'I WAYAN ADITYA PUTRA',
                'email' => 'pmaho_itsupport1@pinusmerahabadi.co.id',
                'phone' => '+62 821-1530-2789',
                'nik' => '00000001',
            ],
        ];

        foreach ($users as $index => $user) {
            User::create([
                'name'       => $user['name'],
                'email'      => $user['email'],
                'phone'      => $user['phone'],
                'nik'        => $user['nik'],
                'branch'     => '-',
                'password'   => Hash::make('pma123'), // Default password sementara
                'role'       => 'IT',
                'role_desc'  => 'System Application support',
            ]);
        }
    }
}
