<?php

// namespace App\Http\Controllers;

// use Exception;
// use GuzzleHttp\Client;
// use App\Models\Filemedia;
// use App\Models\Sheetname;
// use App\Models\Spreadsheet;
// use Illuminate\Http\Request;
// use App\Models\Questionmedia;
// use Illuminate\Support\Facades\Log;

// class SpreadsheetApiController extends Controller
// {
//     public function getDataByToken($token = 'aWarMM')
//     {
//         return $this->getData($token, true);
//     }

//     public function getDataByParam($token, $sheetNames)
//     {
//         $sheetNamesArray = explode(',', $sheetNames);
//         return $this->getData($token, false, $sheetNamesArray);
//     }

//     private function getData($token, $isDefault = true, $sheetNamesArray = [])
//     {
//         $spreadsheet = $this->getSpreadsheet($token);
//         if (!$spreadsheet) {
//             return response()->json(['message' => 'Spreadsheet not found'], 404);
//         }

//         $activeSheetnames = $isDefault
//             ? $spreadsheet->sheetnames()->where('active', true)->pluck('name')->toArray()
//             : $sheetNamesArray;

//         if (empty($activeSheetnames)) {
//             return response()->json(['message' => 'No active sheets found'], 404);
//         }

//         return $this->getQuestions($spreadsheet, $activeSheetnames);
//     }

//     private function getQuestions($spreadsheet, $activeSheetnames)
//     {
//         try {
//             $client = new Client();
//             $questionDatabase = ["Questions" => []];

//             foreach ($activeSheetnames as $sheetName) {
//                 $data = $this->fetchSheetData($client, $spreadsheet->documentId, $sheetName, $spreadsheet->apiKey);
//                 if ($data) {
//                     $this->processSheetData($data, $questionDatabase);
//                 }
//             }

//             return response()->json($questionDatabase);
//         } catch (Exception $e) {
//             return response()->json(['error' => 'An unexpected error occurred.', 'message' => $e->getMessage()], 500);
//         }
//     }

//     public function getMediaByParam($token, $sheetNames)
//     {
//         return $this->getMedia($token, explode(',', $sheetNames));
//     }

//     public function getMediaByToken($token)
//     {
//         $spreadsheet = $this->getSpreadsheet($token);
//         if (!$spreadsheet) {
//             return response()->json(['message' => 'Spreadsheet not found'], 404);
//         }

//         $activeSheets = $spreadsheet->sheetnames()->where('active', true)->pluck('id');
//         return $this->getMedias($activeSheets);
//     }

//     private function getMedia($token, $sheetNamesArray)
//     {
//         $spreadsheet = $this->getSpreadsheet($token);
//         if (!$spreadsheet) {
//             return response()->json(['message' => 'Spreadsheet not found'], 404);
//         }

//         $activeSheets = SheetName::where('spreadsheet_id', $spreadsheet->id)
//             ->whereIn('name', $sheetNamesArray)
//             ->pluck('id');

//         return $this->getMedias($activeSheets);
//     }

//     private function getMedias($activeSheets)
//     {
//         try {
//             $questionMedias = Questionmedia::whereIn('sheetname_id', $activeSheets)->pluck('id');

//             if ($questionMedias->isEmpty()) {
//                 return response()->json(['message' => 'No question media found'], 404);
//             }

//             $fileMedias = Filemedia::whereIn('questionmedia_id', $questionMedias)->get();
//             $mediaList = $fileMedias->map(function ($file) {
//                 return [
//                     'filename' => $file->name,
//                     'type' => $file->type,
//                     'url' => url("uploads/{$file->type}/{$file->name}")
//                 ];
//             });

//             return response()->json(['data' => $mediaList], 200);
//         } catch (Exception $e) {
//             return response()->json(['error' => 'An unexpected error occurred.', 'message' => $e->getMessage()], 500);
//         }
//     }

//     private function getSpreadsheet($token)
//     {
//         try {
//             return Spreadsheet::where('token', $token)->firstOrFail();
//         } catch (Exception $e) {
//             Log::error("Error fetching spreadsheet: " . $e->getMessage());
//             return null;
//         }
//     }

//     private function fetchSheetData(Client $client, $documentId, $sheetName, $apiKey)
//     {
//         $url = "https://sheets.googleapis.com/v4/spreadsheets/{$documentId}/values/{$sheetName}?key={$apiKey}";

//         try {
//             $response = $client->get($url);
//             if ($response->getStatusCode() !== 200) {
//                 throw new Exception("Failed to fetch sheet data for {$sheetName}: HTTP " . $response->getStatusCode());
//             }

//             $data = json_decode($response->getBody(), true);
//             if (json_last_error() !== JSON_ERROR_NONE) {
//                 throw new Exception("Failed to decode JSON for {$sheetName}: " . json_last_error_msg());
//             }

//             return $data;
//         } catch (Exception $e) {
//             Log::error("Error fetching sheet data for {$sheetName}: " . $e->getMessage());
//             return null;
//         }
//     }

//     private function processSheetData(array $data, array &$questionDatabase)
//     {
//         if (empty($data['values'])) {
//             Log::warning("No data values found for sheet.");
//             return;
//         }

//         $startRowIndex = 5; // Start from row 6 (index 5)
//         $headers = $data['values'][$startRowIndex] ?? null;

//         if (!$headers) {
//             Log::warning("Headers row not found in sheet.");
//             return;
//         }

//         for ($i = $startRowIndex + 1; $i < count($data['values']); $i++) {
//             $row = $data['values'][$i];
//             $question = [];

//             foreach ($headers as $index => $header) {
//                 $value = $row[$index] ?? '';
//                 if (!in_array($header, ['C_A', 'A2', 'A3', 'A4', 'A5'])  && is_numeric($value)) {
//                     $value = (int)$value;
//                 }
//                 $question[$header] = $value;
//             }

//             $questionDatabase["Questions"][] = $question;
//         }
//     }
// }
namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use App\Models\Filemedia;
use App\Models\Sheetname;
use App\Models\Spreadsheet;
use Illuminate\Http\Request;
use App\Models\Questionmedia;
use Illuminate\Support\Facades\Log;

class SpreadsheetApiController extends Controller
{
    // public function getDataByToken($token = 'aWarMM')
    // {
    //     return $this->getData($token, true);
    // }

    public function getDataByToken($token = 'aWarMM', Request $request)
    {
        $randomize = $request->query('randomize', 'false') === 'true'; // Ambil parameter randomize
        return $this->getData($token, true, [], $randomize);
    }


    public function getDataByParam($token, $sheetNames, Request $request)
    {
        $sheetNamesArray = explode(',', $sheetNames);
        $randomize = $request->query('randomize', 'false') === 'true'; // Ambil parameter randomize
        return $this->getData($token, false, $sheetNamesArray, $randomize);
    }

    private function getData($token, $isDefault = true, $sheetNamesArray = [], $randomize = false)
    {
        $spreadsheet = $this->getSpreadsheet($token);
        if (!$spreadsheet) {
            return $this->errorResponse('Spreadsheet not found', 404);
        }

        $activeSheetnames = $isDefault
            ? $spreadsheet->sheetnames()->where('active', true)->pluck('name')->toArray()
            : $sheetNamesArray;

        if (empty($activeSheetnames)) {
            return $this->errorResponse('No active sheets found', 404);
        }

        return $this->getQuestions($spreadsheet, $activeSheetnames, $randomize); // Pass randomize here
    }

    private function getQuestions($spreadsheet, $activeSheetnames, $randomize = false)
    {
        try {
            $client = new Client();
            $groupedQuestions = [];

            foreach ($activeSheetnames as $sheetName) {
                $data = $this->fetchSheetData($client, $spreadsheet->documentId, $sheetName, $spreadsheet->apiKey);
                if ($data) {
                    $this->processSheetData($data, $groupedQuestions, $sheetName);
                }
            }

            // Setelah pengelompokan selesai
            if ($randomize) {
                foreach ($groupedQuestions as $topic => $questions) {
                    // Pastikan $questions adalah array sebelum randomisasi
                    if (is_array($questions)) {
                        // Acak semua pertanyaan dalam topik ini
                        $groupedQuestions[$topic] = $this->randomizeQuestions($questions);
                    } else {
                        Log::warning("Expected array for questions, but got: " . gettype($questions));
                    }
                }
            }

            // Gabungkan semua pertanyaan ke dalam satu array
            $flattenedQuestions = [];
            foreach ($groupedQuestions as $topic => $questions) {
                // Pastikan $questions adalah array sebelum digabungkan
                if (is_array($questions)) {
                    $flattenedQuestions = array_merge($flattenedQuestions, $questions);
                }
            }

            // Format respons JSON
            $questionDatabase = ['Questions' => $flattenedQuestions];
            return response()->json($questionDatabase);
        } catch (Exception $e) {
            return $this->errorResponse('An unexpected error occurred.', 500, $e);
        }
    }


    private function processSheetData(array $data, array &$groupedQuestions, $sheetName)
    {
        if (empty($data['values'])) {
            Log::warning("No data values found for sheet.");
            return;
        }

        $startRowIndex = 5; // Start from row 6 (index 5)
        $headers = $data['values'][$startRowIndex] ?? null;

        if (!$headers) {
            Log::warning("Headers row not found in sheet.");
            return;
        }

        // Ekstrak topik dan jenis pertanyaan dari nama sheet
        list($topic, $questionType) = explode('_', $sheetName);

        for ($i = $startRowIndex + 1; $i < count($data['values']); $i++) {
            $row = $data['values'][$i];
            $question = [];

            foreach ($headers as $index => $header) {
                $value = $row[$index] ?? '';
                if (!in_array($header, ['C_A', 'A2', 'A3', 'A4', 'A5']) && is_numeric($value)) {
                    $value = (int)$value;
                }
                $question[$header] = $value;
            }

            // Tambahkan pertanyaan ke dalam grup berdasarkan topik dan jenis
            // $groupedQuestions[$topic][$questionType][] = $question;
            $groupedQuestions[$topic][] = $question;
        }
    }

    private function randomizeQuestions(array $questions): array
    {
        // Pastikan bahwa $questions adalah array
        if (!is_array($questions)) {
            return []; // Kembalikan array kosong jika bukan array
        }

        shuffle($questions); // Acak pertanyaan dalam setiap jenis
        return $questions; // Kembalikan pertanyaan yang sudah diacak
    }


    public function getMediaByParam($token, $sheetNames)
    {
        return $this->getMedia($token, explode(',', $sheetNames));
    }

    public function getMediaByToken($token)
    {
        $spreadsheet = $this->getSpreadsheet($token);
        if (!$spreadsheet) {
            return $this->errorResponse('Spreadsheet not found', 404);
        }

        $activeSheets = $spreadsheet->sheetnames()->where('active', true)->pluck('id');
        return $this->getMedias($activeSheets);
    }

    private function getMedia($token, $sheetNamesArray)
    {
        $spreadsheet = $this->getSpreadsheet($token);
        if (!$spreadsheet) {
            return $this->errorResponse('Spreadsheet not found', 404);
        }

        $activeSheets = SheetName::where('spreadsheet_id', $spreadsheet->id)
            ->whereIn('name', $sheetNamesArray)
            ->pluck('id');

        return $this->getMedias($activeSheets);
    }

    private function getMedias($activeSheets)
    {
        try {
            $questionMedias = Questionmedia::whereIn('sheetname_id', $activeSheets)->pluck('id');

            if ($questionMedias->isEmpty()) {
                return $this->errorResponse('No question media found', 404);
            }

            $fileMedias = Filemedia::whereIn('questionmedia_id', $questionMedias)->get();
            $mediaList = $fileMedias->map(function ($file) {
                return [
                    'filename' => $file->name,
                    'type' => $file->type,
                    'url' => url("uploads/{$file->type}/{$file->name}")
                ];
            });

            return response()->json(['data' => $mediaList], 200);
        } catch (Exception $e) {
            return $this->errorResponse('An unexpected error occurred.', 500, $e);
        }
    }

    private function getSpreadsheet($token)
    {
        try {
            return Spreadsheet::where('token', $token)->firstOrFail();
        } catch (Exception $e) {
            Log::error("Error fetching spreadsheet: " . $e->getMessage());
            return null;
        }
    }

    private function fetchSheetData(Client $client, $documentId, $sheetName, $apiKey)
    {
        $url = "https://sheets.googleapis.com/v4/spreadsheets/{$documentId}/values/{$sheetName}?key={$apiKey}";

        try {
            $response = $client->get($url);
            if ($response->getStatusCode() !== 200) {
                throw new Exception("Failed to fetch sheet data for {$sheetName}: HTTP " . $response->getStatusCode());
            }

            $data = json_decode($response->getBody(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Failed to decode JSON for {$sheetName}: " . json_last_error_msg());
            }

            return $data;
        } catch (Exception $e) {
            Log::error("Error fetching sheet data for {$sheetName}: " . $e->getMessage());
            return null;
        }
    }

    private function errorResponse($message, $statusCode, Exception $e = null)
    {
        if ($e) {
            Log::error($message . ': ' . $e->getMessage());
        }
        return response()->json(['error' => $message], $statusCode);
    }
}
