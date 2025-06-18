<?php

namespace App\Http\Controllers;

use App\Models\Sheetname;
use App\Models\Spreadsheet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class SpreadsheetController extends Controller
{
    public function index()
    {
        return view('./spreadsheet/index', ['title' => 'Spreadsheet Table', 'spreadsheets' => Spreadsheet::all()]);
    }

    public function create()
    {
        return view('./spreadsheet/create', ['title' => 'Create New Spreadsheet']);
    }

    // Function untuk menyimpan data dari form ke database
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'documentId' => 'required|unique:spreadsheets|string|max:255',
            'apiKey' => 'required|string|max:255',
            'token' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        // Simpan data ke tabel spreadsheets
        $spreadsheet = Spreadsheet::create($validatedData);

        try {
            // Ambil nama-nama sheet dari dokumen menggunakan Sheets API
            $documentId = $validatedData['documentId'];
            $apiKey = $validatedData['apiKey'];
            $url = "https://sheets.googleapis.com/v4/spreadsheets/{$documentId}?key={$apiKey}";

            $client = new \GuzzleHttp\Client();
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['sheets'])) {
                $sheets = $data['sheets'];

                // Loop nama-nama sheet dan simpan ke tabel sheetnames
                foreach ($sheets as $sheet) {
                    $sheetTitle = $sheet['properties']['title'] ?? null;

                    if ($sheetTitle) {
                        Sheetname::create([
                            'name' => $sheetTitle,
                            'slug' => Str::slug($sheetTitle),
                            'spreadsheet_id' => $spreadsheet->id,
                            'active' => true, // Default active
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            // Log error jika terjadi kegagalan dalam mengambil nama sheet
            Log::error('Error fetching sheet names: ' . $e->getMessage());
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('spreadsheet.index')->with('success', 'Data berhasil disimpan dan nama sheet berhasil diambil!');
    }

    public function edit($slug)
    {
        // Ambil data berdasarkan Slug
        $data = Spreadsheet::firstWhere('slug', $slug);

        // Tampilkan view dengan data yang diambil
        return view('./spreadsheet/edit', ['title' => 'Edit Spreadsheet', 'spreadsheet' => $data]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input (tanpa 'slug')
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'documentId' => 'required|string|max:255',
            'apiKey' => 'required|string|max:255',
            'token' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        // Ambil data berdasarkan ID
        $data = Spreadsheet::findOrFail($id);

        // Update field dengan slug yang dihasilkan dari title
        $data->update($validated);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('spreadsheet.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $data = Spreadsheet::findOrFail($id);

        // Hapus data
        $data->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('spreadsheet.index')->with('success', 'Data berhasil dihapus.');
    }


    // public function activeStatus()
    // {
    //     return view('./spreadsheet/active-status', ['title' => 'Active Status', 'spreadsheet' => Spreadsheet::where('active', true)->first()]);
    // }

    // public function setActive()
    // {
    //     return view('./spreadsheet/set-active', ['title' => 'Set Active', 'spreadsheets' => Spreadsheet::all()]);
    // }

    // Mengupdate row yang aktif berdasarkan pilihan radio button
    // public function updateActive(Request $request)
    // {
    //     // Validasi input, memastikan ada ID yang dipilih
    //     $request->validate([
    //         'active_row' => 'required|exists:spreadsheets,id' // Sesuaikan nama tabel
    //     ]);

    //     // Nonaktifkan semua row terlebih dahulu
    //     Spreadsheet::query()->update(['active' => false]);

    //     // Aktifkan row yang dipilih
    //     $activeRowId = $request->input('active_row');


    //     // Redirect kembali ke halaman tabel dengan pesan sukses
    //     return redirect()->route('spreadsheet.setActive')->with('success', 'Row berhasil diperbarui.');
    // }
}
