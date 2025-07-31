<?php

namespace App\Http\Controllers;

use App\Models\Synclog;
use App\Models\Filemedia;
use App\Models\Sheetname;
use App\Models\Spreadsheet;
use Illuminate\Http\Request;
use App\Models\Questionmedia;
use App\Models\SynclogDetail;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    private function getWarningData()
    {
        $warningData = [];

        $questionMedias = QuestionMedia::with(['sheetname.spreadsheet', 'fileMedias'])->get();

        foreach ($questionMedias as $questionMedia) {
            $trueFieldsCount = ($questionMedia->image ? 1 : 0) + ($questionMedia->audio ? 1 : 0);
            $fileMediasCount = $questionMedia->fileMedias->count();

            if ($trueFieldsCount > $fileMediasCount) {
                $spreadsheetId = $questionMedia->sheetname->spreadsheet->id;
                $sheetnameId = $questionMedia->sheetname->id;

                if (!isset($warningData[$spreadsheetId])) {
                    $warningData[$spreadsheetId] = [
                        'spreadsheet' => $questionMedia->sheetname->spreadsheet,
                        'sheetnames' => [],
                    ];
                }

                $warningData[$spreadsheetId]['sheetnames'][$sheetnameId] = $questionMedia->sheetname;
            }
        }

        return array_values($warningData);
    }

    public function spreadsheet()
    {
        $warningData = $this->getWarningData();

        return view('./media/spreadsheet', [
            'title' => 'Spreadsheet Media Table',
            'spreadsheets' => Spreadsheet::all(),
            'warningData' => $warningData,
        ]);
    }

    public function sheetname($slug)
    {
        $spreadsheet = Spreadsheet::with('sheetnames')->firstWhere('slug', $slug);
        $warningData = $this->getWarningData();

        return view('./media/sheetname', [
            'title' => 'Sheetname Media Table',
            'spreadsheet' => $spreadsheet,
            'sheetnames' => $spreadsheet->sheetnames,
            'warningData' => $warningData,
        ]);
    }

    public function question($slug)
    {
        $sheetname = Sheetname::with('questionmedias.filemedias')->firstWhere('slug', $slug);

        return view('./media/question', [
            'title' => 'Question Medias Table',
            'sheetname' => $sheetname,
            'questions' => $sheetname->questionmedias,
        ]);
    }

    public function edit($guid)
    {
        // Ambil data berdasarkan ID
        $data = Questionmedia::firstWhere('guid', $guid);

        // Tampilkan view dengan data yang diambil
        return view('./media/edit', ['title' => 'Edit Question Media', 'question' => $data]);
    }

    public function uploadFile(Request $request)
    {
        if (!$request->input('image')) {
            $request->validate([
                'imageFile' => 'required',
            ]);
        }

        if (!$request->input('audio')) {
            $request->validate([
                'audioFile' => 'required',
            ]);
        }

        // Validasi input file
        $validated = $request->validate([
            'imageFile' => 'file|mimes:png|max:2048', // Maksimum 2MB untuk file PNG
            'audioFile' => 'file|mimes:ogg,wav|max:2048', // Maksimum 2MB untuk file OGG atau WAV
        ]);

        // Direktori untuk menyimpan file
        $imageDirectory = 'uploads/image/';
        $audioDirectory = 'uploads/audio/';

        $questionMedia = QuestionMedia::findOrFail($request->input('questionmedia_id'));

        // Proses file image
        if ($request->hasFile('imageFile')) {
            $imageFile = $request->file('imageFile');
            $imageName = $questionMedia->guid . '.' . $imageFile->getClientOriginalExtension();

            // Pindahkan file ke direktori tujuan
            $imageFile->move(public_path($imageDirectory), $imageName);

            // Simpan metadata ke database
            Filemedia::updateOrCreate(
                ['name' => $imageName, 'type' => 'image'],
                ['questionmedia_id' => $questionMedia->id, 'active' => true]
            );
        }

        // Proses file audio
        if ($request->hasFile('audioFile')) {
            $audioFile = $request->file('audioFile');
            $audioName = $questionMedia->guid . '.' . $audioFile->getClientOriginalExtension();

            // Pindahkan file ke direktori tujuan
            $audioFile->move(public_path($audioDirectory), $audioName);

            // Simpan metadata ke database
            Filemedia::updateOrCreate(
                ['name' => $audioName, 'type' => 'audio'],
                ['questionmedia_id' => $questionMedia->id, 'active' => true]
            );
        }

        return redirect()->back()->with('success', 'File berhasil diunggah dan disimpan.');
    }

    public function file()
    {
        return view('./media/file', ['title' => 'File Media Table', 'filemedias' => Filemedia::all()]);
    }

    public function editFile($name)
    {
        // Ambil data berdasarkan ID
        $data = Filemedia::firstWhere('name', $name);

        // Tampilkan view dengan data yang diambil
        return view('./media/edit-file', ['title' => 'Edit File Media', 'filemedia' => $data]);
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $fileMedia = Filemedia::findOrFail($id);

        // Direktori penyimpanan file
        $imageDirectory = public_path('uploads/image/');
        $audioDirectory = public_path('uploads/audio/');

        // GUID tidak ditemukan, hapus file dari direktori dan database
        $filePath = ($fileMedia->type === 'image') ? $imageDirectory . $fileMedia->name : $audioDirectory . $fileMedia->name;

        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file dari direktori
        }

        // Hapus data
        $fileMedia->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('media.file')->with('success', 'Data berhasil dihapus.');
    }

    public function synchronizeQuestion()
    {
        if ($response = $this->checkLastSync('questionmedias')) {
            return $response;
        }

        $spreadsheets = Spreadsheet::with('sheetnames')->get();
        $added = [];
        $deleted = [];
        $addedCount = 0;
        $deletedCount = 0;
        $errors = [];
        $status = 'success';

        foreach ($spreadsheets as $spreadsheet) {
            foreach ($spreadsheet->sheetnames as $sheetname) {
                $result = $this->syncQuestionMedia($sheetname);

                if ($result['status'] === 'error') {
                    $errors[] = "Dokumen {$spreadsheet->title} -> Sheet {$sheetname->name} gagal: {$result['message']}";
                    $status = 'partial';
                } else {
                    if (!empty($result['added'])) {
                        $added[] = "Dokumen {$spreadsheet->title} -> Sheet {$sheetname->name}: " . implode(", ", $result['added']) . " telah ditambahkan.";
                        $addedCount += count($result['added']);
                    }
                    if (!empty($result['deleted'])) {
                        $deleted[] = "Dokumen {$spreadsheet->title} -> Sheet {$sheetname->name}: " . implode(", ", $result['deleted']) . " telah dihapus.";
                        $deletedCount += count($result['deleted']);
                    }
                }
            }
        }

        if (count($errors) === count($spreadsheets)) {
            $status = 'failed';
        }

        $messageParts = [];
        if ($addedCount > 0) $messageParts[] = "{$addedCount} data ditambahkan";
        if ($deletedCount > 0) $messageParts[] = "{$deletedCount} data dihapus";
        if (!empty($errors)) $messageParts[] = "Beberapa dokumen gagal disinkronisasi.";

        $logMessage = empty($messageParts) ? 'Tidak ada perubahan yang terjadi.' : implode(" dan ", $messageParts);

        $syncLog = Synclog::create([
            'process_name' => 'questionmedias',
            'last_synced_at' => now(),
            'status' => $status,
            'message' => $logMessage
        ]);
        $this->createSyncLogDetails($syncLog->id, $added, $deleted, $errors);

        return redirect()->back()->with('success', 'Sinkronisasi selesai.');
    }

    public function synchronizeAllSheet($slug)
    {

        $spreadsheet = Spreadsheet::with('sheetnames')->firstWhere('slug', $slug);

        if ($response = $this->checkLastSync('questionmedias_all_sheet')) {
            return $response;
        }

        $added = [];
        $deleted = [];
        $addedCount = 0;
        $deletedCount = 0;
        $errors = [];
        $status = 'success';

        foreach ($spreadsheet->sheetnames as $sheetname) {
            $result = $this->syncQuestionMedia($sheetname);

            if ($result['status'] === 'error') {
                $errors[] = "Sheet {$sheetname->name} gagal: {$result['message']}";
                $status = 'partial';
            } else {
                if (!empty($result['added'])) {
                    $added[] = "Sheet {$sheetname->name}: " . implode(", ", $result['added']) . " telah ditambahkan.";
                    $addedCount += count($result['added']);
                }
                if (!empty($result['deleted'])) {
                    $deleted[] = "Sheet {$sheetname->name}: " . implode(", ", $result['deleted']) . " telah dihapus.";
                    $deletedCount += count($result['deleted']);
                }
            }
        }

        if (count($errors) === $spreadsheet->sheetnames->count()) {
            $status = 'failed';
        }

        $messageParts = [];
        if ($addedCount > 0) $messageParts[] = "{$addedCount} data ditambahkan";
        if ($deletedCount > 0) $messageParts[] = "{$deletedCount} data dihapus";
        if (!empty($errors)) $messageParts[] = "Beberapa sheet gagal disinkronisasi.";

        $logMessage = empty($messageParts) ? 'Tidak ada perubahan yang terjadi.' : implode(" dan ", $messageParts);

        $syncLog = Synclog::create([
            'process_name' => 'questionmedias_all_sheet',
            'last_synced_at' => now(),
            'status' => $status,
            'message' => $logMessage
        ]);
        $this->createSyncLogDetails($syncLog->id, $added, $deleted, $errors);

        return redirect()->back()->with('success', 'Sinkronisasi Questionmedias untuk dokumen ' . $spreadsheet->title . ' selesai.');
    }

    public function synchronizeSingleSheet($slug)
    {
        $sheetname = Sheetname::with('spreadsheet')->firstWhere('slug', $slug);

        if ($response = $this->checkLastSync('questionmedias_single_sheet')) {
            return $response;
        }

        $result = $this->syncQuestionMedia($sheetname);
        $added = [];
        $deleted = [];
        $errors = [];
        $status = 'success';
        $addedCount = 0;
        $deletedCount = 0;

        if ($result['status'] === 'error') {
            $errors[] = "Sheet {$sheetname->name} gagal: {$result['message']}";
            $status = 'failed';
        } else {
            if (!empty($result['added'])) {
                $added[] = "Sheet {$sheetname->name}: " . implode(", ", $result['added']) . " telah ditambahkan.";
                $addedCount += count($result['added']);
            }
            if (!empty($result['deleted'])) {
                $deleted[] = "Sheet {$sheetname->name}: " . implode(", ", $result['deleted']) . " telah dihapus.";
                $deletedCount += count($result['deleted']);
            }
        }

        $messageParts = [];
        if ($addedCount > 0) $messageParts[] = "{$addedCount} data ditambahkan";
        if ($deletedCount > 0) $messageParts[] = "{$deletedCount} data dihapus";
        if (!empty($errors)) $messageParts[] = "Sheet gagal disinkronisasi.";

        $logMessage = empty($messageParts) ? 'Tidak ada perubahan yang terjadi.' : implode(" dan ", $messageParts);

        $syncLog = Synclog::create([
            'process_name' => 'questionmedias_single_sheet',
            'last_synced_at' => now(),
            'status' => $status,
            'message' => $logMessage
        ]);
        $this->createSyncLogDetails($syncLog->id, $added, $deleted, $errors);

        return redirect()->back()->with('success', 'Sinkronisasi Questionmedias untuk Sheet ' . $sheetname->name . ' selesai.');
    }

    private function syncQuestionMedia(Sheetname $sheetname)
    {
        $spreadsheetId = $sheetname->spreadsheet->documentId;
        $apiKey = $sheetname->spreadsheet->apiKey;
        $sheetName = $sheetname->name;

        $response = Http::get("https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$sheetName}?key={$apiKey}");

        if (!$response->successful()) {
            return ['status' => 'error', 'message' => 'Gagal mengambil data dari API'];
        }

        $data = $response->json('values');
        if (count($data) < 7) {
            return ['status' => 'error', 'message' => 'Data tidak cukup'];
        }

        $headers = $data[5];
        $guidIndex = array_search('GUID', $headers);
        $questionIndex = array_search('Q', $headers);
        $imageIndex = array_search('I', $headers);
        $audioIndex = array_search('A', $headers);

        if ($guidIndex === false || $questionIndex === false || $imageIndex === false) {
            return ['status' => 'error', 'message' => 'Kolom penting tidak ditemukan'];
        }

        $rows = array_slice($data, 6);
        $existingGuids = Questionmedia::where('sheetname_id', $sheetname->id)->pluck('guid')->toArray();
        $newGuids = [];
        $added = [];
        $deleted = [];

        foreach ($rows as $row) {
            if (!isset($row[$guidIndex]) || empty($row[$guidIndex])) continue;

            $guid = $row[$guidIndex];
            $question = $row[$questionIndex] ?? '';
            $hasImage = isset($row[$imageIndex]) && $row[$imageIndex] == 1;
            $hasAudio = $audioIndex !== false && isset($row[$audioIndex]) && $row[$audioIndex] == 1;

            if (!$hasImage && !$hasAudio) continue;

            $newGuids[] = $guid;

            $exists = Questionmedia::where('guid', $guid)->exists();
            if (!$exists) {
                $added[] = $guid;
            }

            QuestionMedia::updateOrCreate(
                ['guid' => $guid],
                [
                    'question' => $question,
                    'image' => $hasImage,
                    'audio' => $hasAudio,
                    'sheetname_id' => $sheetname->id,
                ]
            );
        }

        $guidsToDelete = array_diff($existingGuids, $newGuids);
        if (!empty($guidsToDelete)) {
            QuestionMedia::whereIn('guid', $guidsToDelete)->delete();
            $deleted = array_merge($deleted, $guidsToDelete);
        }

        return [
            'status' => 'success',
            'added' => $added,
            'deleted' => $deleted,
        ];
    }

    private function checkLastSync(string $processName)
    {
        $lastSync = Synclog::where('process_name', $processName)->first();
        if ($lastSync && $lastSync->last_synced_at > now()->subHour()) {
            return response()->json(['message' => 'Sinkronisasi sudah dilakukan baru-baru ini, coba lagi nanti.']);
        }
        return null;
    }

    private function createSyncLogDetails(int $syncLogId, array $added = [], array $deleted = [], array $errors = [])
    {
        if (!empty($added)) {
            SynclogDetail::create([
                'synclog_id' => $syncLogId,
                'category' => 'added',
                'message' => implode(" ", $added)
            ]);
        }
        if (!empty($deleted)) {
            SynclogDetail::create([
                'synclog_id' => $syncLogId,
                'category' => 'deleted',
                'message' => implode(" ", $deleted)
            ]);
        }
        if (!empty($errors)) {
            SynclogDetail::create([
                'synclog_id' => $syncLogId,
                'category' => 'error',
                'message' => implode(" ", $errors)
            ]);
        }
    }

    public function synchronizeFile()
    {
        try {
            // Cek log sinkronisasi terakhir
            $lastSync = Synclog::where('process_name', 'filemedias')->first();

            if ($lastSync && $lastSync->last_synced_at > now()->subHour()) {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Sinkronisasi sudah dilakukan baru-baru ini, coba lagi nanti.'
                ]);
            }

            // 1. Baca Direktori
            $imageDirectory = public_path('uploads/image');
            $audioDirectory = public_path('uploads/audio');
            $existingFiles = array_merge(
                File::files($imageDirectory),
                File::files($audioDirectory)
            );
            $existingFileNames = array_map('basename', $existingFiles);

            // 2. Ambil Data Database
            $fileMedias = Filemedia::all()->keyBy('name');
            $questionMedias = Questionmedia::pluck('id', 'guid');

            $addedFiles = [];
            $deletedFiles = [];
            $updatedFiles = [];

            // 3. Sinkronisasi Penyimpanan dan Database (Mirip syncFileStorage)
            foreach ($existingFileNames as $fileName) {
                if (!isset($fileMedias[$fileName])) {
                    $fileType = strpos($fileName, '.jpg') !== false || strpos($fileName, '.png') !== false ? 'image' : 'audio';
                    Filemedia::create([
                        'name' => $fileName,
                        'type' => $fileType,
                        'active' => 1,
                        'questionmedia_id' => null,
                    ]);
                    $addedFiles[] = $fileName;
                }
            }

            foreach ($fileMedias as $fileName => $fileMedia) {
                if (!in_array($fileName, $existingFileNames)) {
                    $fileMedia->delete();
                    $deletedFiles[] = $fileName;
                }
            }

            // Ambil ulang filemedias setelah proses sinkronisasi penyimpanan
            $fileMedias = Filemedia::all()->keyBy('name');

            // 4. Sinkronisasi Media Pertanyaan (Mirip syncFileMedia)
            foreach ($fileMedias as $fileName => $fileMedia) {
                $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                if (isset($questionMedias[$fileNameWithoutExtension])) {
                    $fileMedia->questionmedia_id = $questionMedias[$fileNameWithoutExtension];
                    $fileMedia->save();
                    $updatedFiles[] = $fileName;
                } else {
                    $filePath = ($fileMedia->type === 'image') ? $imageDirectory . '/' . $fileName : $audioDirectory . '/' . $fileName;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $fileMedia->delete();
                    $deletedFiles[] = $fileName;
                }
            }

            // 5. Pencatatan Log
            $synclog = Synclog::create([
                'process_name' => 'filemedias',
                'last_synced_at' => now(),
                'status' => 'success',
                'message' => count($addedFiles) . " data ditambahkan, " . count($updatedFiles) . " data diubah, dan " . count($deletedFiles) . " data dihapus."
            ]);

            // 6. Pencatatan Log Detail
            if (!empty($addedFiles)) {
                SynclogDetail::create([
                    'synclog_id' => $synclog->id,
                    'category' => 'added',
                    'message' => 'Data ditambahkan: ' . implode(', ', $addedFiles) . '.'
                ]);
            }
            if (!empty($deletedFiles)) {
                SynclogDetail::create([
                    'synclog_id' => $synclog->id,
                    'category' => 'deleted',
                    'message' => 'Data dihapus: ' . implode(', ', $deletedFiles) . '.'
                ]);
            }
            if (!empty($updatedFiles)) {
                SynclogDetail::create([
                    'synclog_id' => $synclog->id,
                    'category' => 'updated',
                    'message' => 'Data diubah: ' . implode(', ', $updatedFiles) . '.'
                ]);
            }

            // return response()->json([
            //     'status' => 'success',
            //     'message' => $synclog->message
            // ]);
            return redirect()->back()->with('success', 'Sinkronisasi selesai.');
        } catch (\Exception $e) {
            $synclog = Synclog::create([
                'process_name' => 'filemedias',
                'last_synced_at' => now(),
                'status' => 'failed',
                'message' => 'Terjadi kesalahan saat sinkronisasi file media: ' . $e->getMessage()
            ]);

            SynclogDetail::create([
                'synclog_id' => $synclog->id,
                'category' => 'error',
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $synclog->message
            ], 500);
        }
    }
}
