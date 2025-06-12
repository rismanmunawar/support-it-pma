<?php

namespace App\Imports;

use App\Models\LogData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LogDataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new LogData([
            'tanggal' => \Carbon\Carbon::parse($row['tanggal']),
            'keterangan' => $row['keterangan'],
            'nama_user' => $row['nama_user'],
        ]);
    }
}
