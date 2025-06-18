<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Synclog;
use App\Models\Sheetname;
use App\Models\Spreadsheet;
use Illuminate\Http\Request;
use App\Models\SynclogDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SheetnameController extends Controller
{
    public function index()
    {
        return view('./sheetname/index', ['title' => 'Sheetnames Table', 'spreadsheets' => Spreadsheet::all()]);
    }

    public function active($slug)
    {
        // Data Spreadsheet (API Key dan Document ID)
        $spreadsheet = Spreadsheet::with('sheetnames')->firstWhere('slug', $slug);

        return view('./sheetname/active', [
            'title' => 'Set Active Sheetname',
            'spreadsheet' => $spreadsheet,
            'sheetnames' => $spreadsheet->sheetnames, // Langsung akses sheetnames melalui relasi
        ]);
    }


    public function update(Request $request)
    {
        $spreadsheetId = $request->input('spreadsheet_id');
        $selectedSheets = $request->input('active', []); // Nama-nama sheet yang dicentang

        // Ambil nama-nama sheet dari database berdasarkan spreadsheet_id
        $sheetnames = Sheetname::where('spreadsheet_id', $spreadsheetId)->get();

        // Iterasi nama-nama sheet di database
        foreach ($sheetnames as $sheetname) {
            // Update status active sesuai dengan apakah sheet dicentang atau tidak
            $sheetname->update([
                'active' => in_array($sheetname->name, $selectedSheets),
            ]);
        }

        return redirect()->back()->with('success', 'Sheetnames successfully updated.');
    }

    // public function synchronizeAll()
    // {
    //     $syncLog = Synclog::create([
    //         'process_name' => 'sheetnames',
    //         'last_synced_at' => Carbon::now(),
    //         'status' => 'success',
    //         'message' => ''
    //     ]);

    //     $addedSheets = [];
    //     $deletedSheets = [];
    //     $errorDocs = [];
    //     $totalAdded = 0;
    //     $totalDeleted = 0;

    //     $spreadsheets = Spreadsheet::with('sheetnames')->get();

    //     foreach ($spreadsheets as $spreadsheet) {
    //         $documentId = $spreadsheet->documentId;
    //         $apiKey = $spreadsheet->apiKey;

    //         try {
    //             $apiUrl = "https://sheets.googleapis.com/v4/spreadsheets/{$documentId}?fields=sheets.properties.title&key={$apiKey}";
    //             $response = Http::get($apiUrl);

    //             if ($response->successful()) {
    //                 $sheetTitles = collect($response->json('sheets'))
    //                     ->pluck('properties.title')
    //                     ->toArray();

    //                 $existingSheetnames = Sheetname::where('spreadsheet_id', $spreadsheet->id)->get();

    //                 $added = [];
    //                 foreach ($sheetTitles as $title) {
    //                     if (!$existingSheetnames->contains('name', $title)) {
    //                         Sheetname::create([
    //                             'name' => $title,
    //                             'spreadsheet_id' => $spreadsheet->id,
    //                             'active' => false,
    //                         ]);
    //                         $added[] = $title;
    //                     }
    //                 }

    //                 $deleted = [];
    //                 foreach ($existingSheetnames as $sheetname) {
    //                     if (!in_array($sheetname->name, $sheetTitles)) {
    //                         $deleted[] = $sheetname->name;
    //                         $sheetname->delete();
    //                     }
    //                 }

    //                 if (!empty($added)) {
    //                     $addedSheets[] = "Dokumen {$spreadsheet->title}: " . implode(', ', $added) . " telah ditambahkan.";
    //                     $totalAdded += count($added);
    //                 }
    //                 if (!empty($deleted)) {
    //                     $deletedSheets[] = "Dokumen {$spreadsheet->title}: " . implode(', ', $deleted) . " telah dihapus.";
    //                     $totalDeleted += count($deleted);
    //                 }
    //             } else {
    //                 $errorDocs[] = "Dokumen {$spreadsheet->title}: " . $response->body();
    //             }
    //         } catch (\Exception $e) {
    //             $errorDocs[] = "Dokumen {$spreadsheet->title}: " . $e->getMessage();
    //         }
    //     }

    //     if (!empty($addedSheets)) {
    //         SynclogDetail::create([
    //             'synclog_id' => $syncLog->id,
    //             'category' => 'added',
    //             'message' => implode(' ', $addedSheets)
    //         ]);
    //     }
    //     if (!empty($deletedSheets)) {
    //         SynclogDetail::create([
    //             'synclog_id' => $syncLog->id,
    //             'category' => 'deleted',
    //             'message' => implode(' ', $deletedSheets)
    //         ]);
    //     }
    //     if (!empty($errorDocs)) {
    //         SynclogDetail::create([
    //             'synclog_id' => $syncLog->id,
    //             'category' => 'error',
    //             'message' => implode(' ', $errorDocs)
    //         ]);
    //     }

    //     if (count($errorDocs) === $spreadsheets->count()) {
    //         $syncLog->update(['status' => 'failed', 'message' => "Semua dokumen gagal disinkronisasi."]);
    //     } elseif (!empty($errorDocs)) {
    //         $syncLog->update(['status' => 'partial', 'message' => "$totalAdded data ditambahkan, $totalDeleted data dihapus, dan " . count($errorDocs) . " dokumen gagal disinkronisasi."]);
    //     } else {
    //         $syncLog->update(['status' => 'success', 'message' => "$totalAdded data ditambahkan dan $totalDeleted data dihapus."]);
    //     }

    //     return redirect()->back()->with('success', 'Sinkronisasi selesai.');
    // }


    // public function synchronizeOne($spreadsheet)
    // {
    //     $documentId = $spreadsheet->documentId;
    //     $apiKey = $spreadsheet->apiKey;

    //     // Panggil Google Sheets API untuk mendapatkan daftar nama sheet
    //     $apiUrl = "https://sheets.googleapis.com/v4/spreadsheets/{$documentId}?fields=sheets.properties.title&key={$apiKey}";

    //     try {
    //         $response = Http::get($apiUrl);

    //         if ($response->successful()) {
    //             $sheetTitles = collect($response->json('sheets'))
    //                 ->pluck('properties.title')
    //                 ->toArray(); // Ambil nama-nama sheet dalam array

    //             // Ambil nama-nama sheet yang sudah ada di database untuk dokumen ini
    //             $existingSheetnames = Sheetname::where('spreadsheet_id', $spreadsheet->id)->get();

    //             // Sinkronisasi: Tambahkan nama sheet baru yang belum ada di database
    //             foreach ($sheetTitles as $title) {
    //                 if (!$existingSheetnames->contains('name', $title)) {
    //                     Sheetname::create([
    //                         'name' => $title,
    //                         'spreadsheet_id' => $spreadsheet->id,
    //                         'active' => false, // Default aktifasi adalah false
    //                     ]);
    //                 }
    //             }

    //             // Sinkronisasi: Hapus nama sheet yang ada di database tetapi tidak ada di dokumen
    //             foreach ($existingSheetnames as $sheetname) {
    //                 if (!in_array($sheetname->name, $sheetTitles)) {
    //                     $sheetname->delete();
    //                 }
    //             }
    //         } else {
    //             // Jika API gagal, tampilkan pesan error (log untuk debugging)
    //             Log::error("Failed to fetch sheets for documentId: {$documentId}", [
    //                 'response' => $response->body()
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         // Tangani error dari HTTP request atau lainnya
    //         Log::error("Error while synchronizing sheets for documentId: {$documentId}", [
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    public function synchronizeSingle($slug)
    {
        $spreadsheet = Spreadsheet::with('sheetnames')->firstWhere('slug', $slug);
        $syncLog = Synclog::create([
            'process_name' => 'sheetnames_single',
            'last_synced_at' => Carbon::now(),
            'status' => 'success',
            'message' => '',
        ]);

        $result = $this->synchronizeSpreadsheet($spreadsheet, $syncLog);

        if (!empty($result['addedSheets'])) {
            SynclogDetail::create([
                'synclog_id' => $syncLog->id,
                'category' => 'added',
                'message' => implode(' ', $result['addedSheets']),
            ]);
        }
        if (!empty($result['deletedSheets'])) {
            SynclogDetail::create([
                'synclog_id' => $syncLog->id,
                'category' => 'deleted',
                'message' => implode(' ', $result['deletedSheets']),
            ]);
        }
        if ($result['error']) {
            SynclogDetail::create([
                'synclog_id' => $syncLog->id,
                'category' => 'error',
                'message' => $result['error'],
            ]);
            $syncLog->update(['status' => 'failed', 'message' => "Dokumen gagal disinkronisasi."]);
        } else {
            $syncLog->update(['status' => 'success', 'message' => "{$result['totalAdded']} data ditambahkan dan {$result['totalDeleted']} data dihapus."]);
        }

        return redirect()->back()->with('success', 'Sinkronisasi selesai.');
    }

    public function synchronizeAll()
    {
        $syncLog = Synclog::create([
            'process_name' => 'sheetnames',
            'last_synced_at' => Carbon::now(),
            'status' => 'success',
            'message' => '',
        ]);

        $addedSheets = [];
        $deletedSheets = [];
        $errorDocs = [];
        $totalAdded = 0;
        $totalDeleted = 0;

        $spreadsheets = Spreadsheet::with('sheetnames')->get();

        foreach ($spreadsheets as $spreadsheet) {
            $result = $this->synchronizeSpreadsheet($spreadsheet, $syncLog);

            if (!empty($result['addedSheets'])) {
                $addedSheets = array_merge($addedSheets, $result['addedSheets']);
                $totalAdded += $result['totalAdded'];
            }
            if (!empty($result['deletedSheets'])) {
                $deletedSheets = array_merge($deletedSheets, $result['deletedSheets']);
                $totalDeleted += $result['totalDeleted'];
            }
            if ($result['error']) {
                $errorDocs[] = $result['error'];
            }
        }

        if (!empty($addedSheets)) {
            SynclogDetail::create([
                'synclog_id' => $syncLog->id,
                'category' => 'added',
                'message' => implode(' ', $addedSheets),
            ]);
        }
        if (!empty($deletedSheets)) {
            SynclogDetail::create([
                'synclog_id' => $syncLog->id,
                'category' => 'deleted',
                'message' => implode(' ', $deletedSheets),
            ]);
        }
        if (!empty($errorDocs)) {
            SynclogDetail::create([
                'synclog_id' => $syncLog->id,
                'category' => 'error',
                'message' => implode(' ', $errorDocs),
            ]);
        }

        if (count($errorDocs) === $spreadsheets->count()) {
            $syncLog->update(['status' => 'failed', 'message' => "Semua dokumen gagal disinkronisasi."]);
        } elseif (!empty($errorDocs)) {
            $syncLog->update(['status' => 'partial', 'message' => "$totalAdded data ditambahkan, $totalDeleted data dihapus, dan " . count($errorDocs) . " dokumen gagal disinkronisasi."]);
        } else {
            $syncLog->update(['status' => 'success', 'message' => "$totalAdded data ditambahkan dan $totalDeleted data dihapus."]);
        }

        return redirect()->back()->with('success', 'Sinkronisasi selesai.');
    }

    private function synchronizeSpreadsheet(Spreadsheet $spreadsheet, Synclog $syncLog)
    {
        $addedSheets = [];
        $deletedSheets = [];
        $error = null;
        $totalAdded = 0;
        $totalDeleted = 0;

        $documentId = $spreadsheet->documentId;
        $apiKey = $spreadsheet->apiKey;

        try {
            $apiUrl = "https://sheets.googleapis.com/v4/spreadsheets/{$documentId}?fields=sheets.properties.title&key={$apiKey}";
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $sheetTitles = collect($response->json('sheets'))
                    ->pluck('properties.title')
                    ->toArray();

                // Menggunakan relasi yang sudah di-load
                $existingSheetnames = $spreadsheet->sheetnames;

                $added = [];
                foreach ($sheetTitles as $title) {
                    if (!$existingSheetnames->contains('name', $title)) {
                        Sheetname::create([
                            'name' => $title,
                            'spreadsheet_id' => $spreadsheet->id,
                            'active' => false,
                        ]);
                        $added[] = $title;
                    }
                }

                $deleted = [];
                foreach ($existingSheetnames as $sheetname) {
                    if (!in_array($sheetname->name, $sheetTitles)) {
                        $deleted[] = $sheetname->name;
                        $sheetname->delete();
                    }
                }

                if (!empty($added)) {
                    $addedSheets[] = "Dokumen {$spreadsheet->title}: " . implode(', ', $added) . " telah ditambahkan.";
                    $totalAdded += count($added);
                }
                if (!empty($deleted)) {
                    $deletedSheets[] = "Dokumen {$spreadsheet->title}: " . implode(', ', $deleted) . " telah dihapus.";
                    $totalDeleted += count($deleted);
                }
            } else {
                $error = "Dokumen {$spreadsheet->title}: " . $response->body();
            }
        } catch (\Exception $e) {
            $error = "Dokumen {$spreadsheet->title}: " . $e->getMessage();
        }

        return [
            'addedSheets' => $addedSheets,
            'deletedSheets' => $deletedSheets,
            'error' => $error,
            'totalAdded' => $totalAdded,
            'totalDeleted' => $totalDeleted,
        ];
    }
}
