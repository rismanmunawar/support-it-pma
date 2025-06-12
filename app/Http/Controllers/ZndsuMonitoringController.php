<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZndsuMonitoring;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class ZndsuMonitoringController extends Controller
{
    public function index()
    {
        $data = ZndsuMonitoring::all();
        $lastUpdated = ZndsuMonitoring::latest('updated_at')->first()?->updated_at;

        $firstRow = $data->first();
        $headers = $firstRow?->status_headers ?? [];

        return view('dashboard', compact('data', 'lastUpdated', 'headers'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx'
        ]);

        $path = $request->file('file')->getRealPath();
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        ZndsuMonitoring::truncate();

        $header = $rows[0];
        $firstDateColIndex = 2;
        $lastDateColIndex = count($header) - 1;

        $statusHeaders = array_slice($header, $firstDateColIndex);

        foreach (array_slice($rows, 1) as $row) {
            $plant = $row[0] ?? null;
            $name = $row[1] ?? null;

            $statuses = [];
            for ($i = $firstDateColIndex; $i <= $lastDateColIndex; $i++) {
                $val = $row[$i] ?? '';
                $statuses[] = match ($val) {
                    '@0V@' => 'ok',
                    '@30@' => 'fail',
                    '@3O@' => 'libur',
                    '@02@' => 'warn',
                    default => ''
                };
            }

            $jml_x = collect($statuses)->filter(fn($s) => in_array($s, ['fail', 'warn']))->count();

            if ($jml_x > 0) {
                ZndsuMonitoring::create([
                    'plant' => $plant,
                    'name' => $name,
                    'statuses' => $statuses,
                    'status_headers' => $statusHeaders,
                    'jml_x' => $jml_x,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui!');
    }
}
