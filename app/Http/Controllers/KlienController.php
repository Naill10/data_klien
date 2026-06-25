<?php
namespace App\Http\Controllers;
use App\Models\Klien;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;



class KlienController extends Controller
{


public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:2048',
    ]);

    $file = $request->file('file');
    $spreadsheet = IOFactory::load($file->getPathname());
    $rows = $spreadsheet->getActiveSheet()->toArray();

    // Skip baris pertama (header)
    array_shift($rows);

    $berhasil = 0;
    $gagal = 0;

    foreach ($rows as $row) {
        // Skip baris kosong
        if (empty($row[0]) && empty($row[1])) continue;

        try {
            Klien::create([
                'nama_klien'        => $row[0] ?? '-',
                'nama_perusahaan'   => $row[1] ?? '-',
                'email'             => $row[2] ?? null,
                'no_telpon'         => $row[3] ?? null,
                'status'            => in_array($row[4], ['Aktif', 'Tidak Aktif']) ? $row[4] : 'Tidak Aktif',
                'tanggal_kerjasama' => !empty($row[5]) ? $row[5] : null,
                'alamat'            => $row[6] ?? null,
                'catatan'           => $row[7] ?? null,
                'user_id'           => auth()->id(),
            ]);
            $berhasil++;
        } catch (\Exception $e) {
            $gagal++;
        }
    }

    return redirect()->route('klien.index')
        ->with('success', "Import berhasil! $berhasil data masuk" . ($gagal > 0 ? ", $gagal data gagal." : "."));
}

public function downloadTemplate()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom
    $sheet->fromArray([
        'nama_klien', 'nama_perusahaan', 'email', 'no_telpon', 'status', 'tanggal_kerjasama', 'alamat', 'catatan'
    ], null, 'A1');

    // Contoh data
    $sheet->fromArray([
        'Pak Budi', 'PT Contoh Indonesia', 'budi@email.com', '08123456789', 'Aktif', '2024-01-01', 'Jakarta', 'Catatan contoh'
    ], null, 'A2');

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="template-klien.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

// Export Excel
public function exportExcel()
{
    $klien = Klien::where('user_id', auth()->id())->latest()->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->fromArray(['No', 'Nama Klien', 'Perusahaan', 'Email', 'No. Telpon', 'Status', 'Tanggal', 'Alamat', 'Catatan'], null, 'A1');

    foreach ($klien as $i => $item) {
        $sheet->fromArray([
            $i + 1,
            $item->nama_klien,
            $item->nama_perusahaan,
            $item->email ?? '-',
            $item->no_telpon ?? '-',
            $item->status,
            $item->tanggal_kerjasama ? \Carbon\Carbon::parse($item->tanggal_kerjasama)->format('d M Y') : '-',
            $item->alamat ?? '-',
            $item->catatan ?? '-',
        ], null, 'A' . ($i + 2));
    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="data-klien.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

// Export PDF
public function exportPdf()
{
    $klien = Klien::where('user_id', auth()->id())->latest()->get();
    $pdf = Pdf::loadView('exports.klien-pdf', compact('klien'));
    return $pdf->download('data-klien.pdf');
}

public function index(Request $request)
{
    $search = $request->get('search');

    $klien = Klien::where('user_id', auth()->id()) 
        ->when($search, function ($query) use ($search) {
            $query->where('nama_klien', 'like', "%{$search}%")
                  ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->latest()->paginate(10);

    return view('pages.klien.index', compact('klien', 'search'));
}

public function store(Request $request)
{
    
        $validated = $request->validate([
    'nama_klien'        => 'required|string|max:255',
    'nama_perusahaan'   => 'required|string|max:255',
    'email'             => 'nullable|email|max:255',
    'no_telpon'         => 'nullable|string|max:20',
    'alamat'            => 'nullable|string',
    'status'            => 'required|in:Aktif,Tidak Aktif',
    'tanggal_kerjasama' => 'nullable|date_format:Y-m-d|after:1900-01-01|before:2100-01-01',
    'catatan'           => 'nullable|string',
]);

    Klien::create([
        ...$validated,               // ✅ pakai variable-nya
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('klien.index')
                     ->with('success', 'Data klien berhasil ditambahkan!');
}

// Form tambah klien
public function create()
{
    return view('pages.klien.create');
}

// Update data klien
public function update(Request $request, Klien $klien)
{
    if ($klien->user_id !== auth()->id()) {
        abort(403);
    }

    $validated = $request->validate([
    'nama_klien'        => 'required|string|max:255',
    'nama_perusahaan'   => 'required|string|max:255',
    'email'             => 'nullable|email|max:255',
    'no_telpon'         => 'nullable|string|max:20',
    'alamat'            => 'nullable|string',
    'status'            => 'required|in:Aktif,Tidak Aktif',
    'tanggal_kerjasama' => 'nullable|date_format:Y-m-d|after:1900-01-01|before:2100-01-01', // ✅
    'catatan'           => 'nullable|string',
]);

    $klien->update($validated);  // ✅ pakai variable-nya

    return redirect()->route('klien.index')
                     ->with('success', 'Data klien berhasil diupdate!');
}

// Form edit klien
public function edit(Klien $klien)
{
    return view('pages.klien.edit', compact('klien'));
}

// Hapus data klien
public function destroy(Klien $klien)
{
  
    if ($klien->user_id !== auth()->id()) { 
        abort(403);
    }

    $klien->delete();

    return redirect()->route('klien.index')
                     ->with('success', 'Data klien berhasil dihapus!');
}
//detail data klien
public function show(Klien $klien)
{
    if ($klien->user_id !== auth()->id()) {
        abort(403);
    }
    
    return view('pages.klien.show', compact('klien'));
}
}