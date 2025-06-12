<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\ZndsuMonitoring;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        $lastUpdate = ZndsuMonitoring::max('uploaded_at');
        $data = ZndsuMonitoring::orderBy('plant')->get();

        // Hitung dayCount berdasarkan data pertama
        $first = $data->first();
        $dayCount = 0;
        if ($first) {
            for ($i = 1; $i <= 31; $i++) {
                if (!is_null($first->{"day_$i"})) {
                    $dayCount++;
                }
            }
        }

        return view('dashboard', compact('data', 'lastUpdate', 'dayCount'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $raw = $sheet->toArray();

        // Validasi minimal ada 3 kolom
        if (empty($raw) || count($raw[0]) < 3) {
            return back()->withErrors(['file' => 'Format file tidak sesuai.']);
        }

        $header = $raw[0]; // Baris pertama sebagai header
        $firstDateColIndex = 2; // Kolom ke-3 dan seterusnya adalah tanggal
        $tanggalList = array_slice($header, $firstDateColIndex);

        // Hapus data sebelumnya
        DB::table('monitoring_zndsu')->truncate();

        foreach (array_slice($raw, 1) as $row) {
            // Pastikan kolom 0 (plant) dan 1 (name) ada
            if (!isset($row[0], $row[1])) continue;

            $plant = $row[0];
            $name = $row[1];
            $statuses = [];

            foreach ($tanggalList as $i => $tglExcel) {
                try {
                    $tgl = Carbon::instance(Date::excelToDateTimeObject($tglExcel));
                } catch (\Exception $e) {
                    continue; // Lewati jika format tanggal tidak valid
                }

                $cell = $row[$i + $firstDateColIndex] ?? '';
                $cell = trim($cell);

                // Jika kosong dan bukan weekend, anggap @3O@
                if (!$tgl->isWeekend() && $cell === '') {
                    $cell = '@3O@';
                }

                // Mapping kode ke status
                $status = match ($cell) {
                    '@0V@' => 'ok',
                    '@30@' => 'fail',
                    '@02@' => 'warn',
                    '@3O@' => 'libur',
                    default => '', // Bisa juga pakai 'unknown'
                };

                $statuses[] = $status;
            }

            // Skip baris jika semua 'libur'
            if (collect($statuses)->every(fn($s) => $s === 'libur')) {
                continue;
            }

            // Skip jika tidak ada '@02@' (alias 'warn')
            if (!collect($statuses)->contains('warn')) {
                continue;
            }

            // Hitung jumlah warn saja untuk jml_x
            $jml_x = collect($statuses)->filter(fn($s) => $s === 'warn')->count();

            // Simpan ke DB
            $zndsu = new ZndsuMonitoring();
            $zndsu->plant = $plant;
            $zndsu->name = $name;
            $zndsu->jml_x = $jml_x;
            $zndsu->uploaded_at = now();

            foreach ($statuses as $index => $status) {
                $colName = 'day_' . ($index + 1);
                $zndsu->$colName = $status;
            }

            $zndsu->save();
        }

        return redirect()->route('dashboard')->with('success', 'Data berhasil diupload!');
    }
}
