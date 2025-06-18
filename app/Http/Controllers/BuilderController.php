<?php

namespace App\Http\Controllers;

use App\Models\Filemedia;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    public function truefalse()
    {
        return view('./builder/truefalse', ['title' => 'True or False Question']);
    }

    public function multichoice()
    {
        return view('./builder/multichoice', ['title' => 'Multiple Choice Question']);
    }

    public function shortanswer()
    {
        return view('./builder/shortanswer', ['title' => 'Short Answer Question']);
    }

    public function bundle()
    {
        return view('./builder/bundle', ['title' => 'Question Bundle']);
    }

    public function store_default(Request $request)
    {
        $request->validate([
            'quest_type' => 'required|in:tf,mc,sa',
            'quest_amount' => 'required|integer|min:1|max:20',
            'time' => 'nullable|integer',
            'encode' => 'required|boolean',
            'standards' => 'nullable|string|max:255',
            'scope' => 'required|boolean',
            'reward_type' => 'required|string|max:255',
            'reward_id' => 'nullable|integer',
            'reward_amount' => 'nullable|integer',
            'penalty_type' => 'required|string|max:255',
            'penalty_id' => 'nullable|integer',
            'penalty_amount' => 'nullable|integer',
        ]);

        $questionType = $request->input('quest_type');
        $questionAmount = $request->input('quest_amount');
        $defaultValues = $request->except(['_token', 'quest_type', 'quest_amount']);

        return redirect()->route('builder.questions.form', [
            'type' => $questionType,
            'amount' => $questionAmount,
            'defaults' => http_build_query($defaultValues),
        ]);
    }

    public function questions_form(string $type, int $amount, Request $request)
    {
        $defaultsQuery = $request->query('defaults');
        $defaults = [];
        parse_str($defaultsQuery, $defaults);

        return view("./builder/bundle-$type", [
            'title' => "bundle $type question",
            'questionType' => $type,
            'questionAmount' => $amount,
            'defaultValues' => $defaults,
        ]);
    }

    public function store_bundle_tf(Request $request)
    {
        // Validasi data input untuk setiap pertanyaan
        $validatedData = $request->validate([
            'questions.*.text' => 'required|string|max:255',
            'questions.*.answer' => 'required|in:0,1', // 0 untuk True, 1 untuk False
            'questions.*.whyWrong' => 'nullable|string|max:255',
        ]);

        $allQuestions = [];
        $questionsData = $request->input('questions');
        $defaults = $request->input('defaults', []); // Ambil nilai default, jika ada

        // Loop melalui setiap pertanyaan yang dikirimkan
        foreach ($questionsData as $index => $questionData) {
            $correctAnswer = $questionData['answer'];
            $question = [
                'Note' => 'Add note here',
                'GUID' => 'MZQ-' . strtolower(($this->guidRand() . '-' . $this->guidRand() . "-" . $this->guidRand())),
                'E' => $defaults['encode'] ?? 0, // Ambil dari defaults atau gunakan nilai default
                'Q_T' => '9',
                'Q' => $questionData['text'],
                'T' => isset($defaults['time']) ? $defaults['time'] * 60 : '0', // Ambil dari defaults atau gunakan nilai default
                'I' => '0',
                'A' => '0',
                'C_A' => ($correctAnswer == '0') ?  rand(1, 1000) : rand(1001, 2000), // Generate C_A berdasarkan jawaban
                'S' => $defaults['standards'] ?? '', // Ambil dari defaults atau gunakan nilai default
                'R_T' => $defaults['reward_type'] ?? 'None', // Ambil dari defaults atau gunakan nilai default
                'R_I' => $defaults['reward_id'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'R_A' => $defaults['reward_amount'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'P_T' => $defaults['penalty_type'] ?? 'None', // Ambil dari defaults atau gunakan nilai default
                'P_I' => $defaults['penalty_id'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'P_A' => $defaults['penalty_amount'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'O_L' => $defaults['scope'] ?? 0, // Ambil dari defaults atau gunakan nilai default
                'A2_Why' => $questionData['whyWrong'] ?? '',
            ];
            $allQuestions[] = $question;
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses dengan semua pertanyaan
        return view('./builder/bundle-created', [
            'title' => 'Questions Created',
            'questions' => $allQuestions, // Mengirimkan array berisi semua pertanyaan
            'success' => 'Pertanyaan bundle berhasil dibuat!',
        ]);
    }

    public function store_bundle_mc(Request $request)
    {
        // Validasi data input untuk setiap pertanyaan
        $validatedData = $request->validate([
            'questions.*.text' => 'required|string|max:255',
            'questions.*.answer' => 'required|string|max:255',
            'questions.*.answer_2' => 'required|string|max:255',
            'questions.*.why_a2' => 'nullable|string|max:255',
            'questions.*.answer_3' => 'nullable|string|max:255',
            'questions.*.why_a3' => 'nullable|string|max:255',
            'questions.*.answer_4' => 'nullable|string|max:255',
            'questions.*.why_a4' => 'nullable|string|max:255',
            'questions.*.answer_5' => 'nullable|string|max:255',
            'questions.*.why_a5' => 'nullable|string|max:255',
        ]);

        $allQuestions = [];
        $questionsData = $request->input('questions');
        $defaults = $request->input('defaults', []); // Ambil nilai default, jika ada

        // Loop melalui setiap pertanyaan yang dikirimkan
        foreach ($questionsData as $index => $questionData) {
            $Q_T = '2';
            if ($questionData['answer_3']) {
                $Q_T = '3';
                if ($questionData['answer_4']) {
                    $Q_T = '4';
                    if ($questionData['answer_5']) {
                        $Q_T = '5';
                    }
                }
            }
            $question = [
                'Note' => 'Add note here',
                'GUID' => 'MZQ-' . strtolower(($this->guidRand() . '-' . $this->guidRand() . "-" . $this->guidRand())),
                'E' => $defaults['encode'] ?? 0, // Ambil dari defaults atau gunakan nilai default
                'Q_T' => $Q_T,
                'Q' => $questionData['text'],
                'T' => isset($defaults['time']) ? $defaults['time'] * 60 : '0', // Ambil dari defaults atau gunakan nilai default
                'I' => '0',
                'A' => '0',
                'C_A' => $questionData['answer'],
                'A2' => $questionData['answer_2'],
                'A2_Why' => $questionData['why_a2'] ?? '',
                'A3' => $questionData['answer_3'] ?? '',
                'A3_Why' => $questionData['why_a3'] ?? '',
                'A4' => $questionData['answer_4'] ?? '',
                'A4_Why' => $questionData['why_a4'] ?? '',
                'A5' => $questionData['answer_5'] ?? '',
                'A5_Why' => $questionData['why_a5'] ?? '',
                'S' => $defaults['standards'] ?? '', // Ambil dari defaults atau gunakan nilai default
                'R_T' => $defaults['reward_type'] ?? 'None', // Ambil dari defaults atau gunakan nilai default
                'R_I' => $defaults['reward_id'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'R_A' => $defaults['reward_amount'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'P_T' => $defaults['penalty_type'] ?? 'None', // Ambil dari defaults atau gunakan nilai default
                'P_I' => $defaults['penalty_id'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'P_A' => $defaults['penalty_amount'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'O_L' => $defaults['scope'] ?? 0, // Ambil dari defaults atau gunakan nilai default
            ];
            $allQuestions[] = $question;
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses dengan semua pertanyaan
        return view('./builder/bundle-created', [
            'title' => 'Questions Created',
            'questions' => $allQuestions, // Mengirimkan array berisi semua pertanyaan
            'success' => 'Pertanyaan bundle berhasil dibuat!',
        ]);
    }

    public function store_bundle_sa(Request $request)
    {
        // Validasi data input untuk setiap pertanyaan
        $validatedData = $request->validate([
            'questions.*.text' => 'required|string|max:255',
            'questions.*.sensitive' => 'required|in:0,1', // 0 untuk False, 1 untuk True
            'questions.*.answer' => 'nullable|string|max:255',
        ]);

        $allQuestions = [];
        $questionsData = $request->input('questions');
        $defaults = $request->input('defaults', []); // Ambil nilai default, jika ada

        // Loop melalui setiap pertanyaan yang dikirimkan
        foreach ($questionsData as $index => $questionData) {
            $question = [
                'Note' => 'Add note here',
                'GUID' => 'MZQ-' . strtolower(($this->guidRand() . '-' . $this->guidRand() . "-" . $this->guidRand())),
                'E' => $defaults['encode'] ?? 0, // Ambil dari defaults atau gunakan nilai default
                'Q_T' => '1',
                'T' => isset($defaults['time']) ? $defaults['time'] * 60 : '0', // Ambil dari defaults atau gunakan nilai default
                'Q' => $questionData['text'],
                'I' => '0',
                'C_A' => str_replace(' ', ';', $questionData['answer']),
                'C_S' => $questionData['sensitive'],
                'S' => $defaults['standards'] ?? '', // Ambil dari defaults atau gunakan nilai default
                'R_T' => $defaults['reward_type'] ?? 'None', // Ambil dari defaults atau gunakan nilai default
                'R_I' => $defaults['reward_id'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'R_A' => $defaults['reward_amount'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'P_T' => $defaults['penalty_type'] ?? 'None', // Ambil dari defaults atau gunakan nilai default
                'P_I' => $defaults['penalty_id'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'P_A' => $defaults['penalty_amount'] ?? '0', // Ambil dari defaults atau gunakan nilai default
                'O_L' => $defaults['scope'] ?? 0, // Ambil dari defaults atau gunakan nilai default
            ];
            $allQuestions[] = $question;
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses dengan semua pertanyaan
        return view('./builder/bundle-created', [
            'title' => 'Questions Created',
            'questions' => $allQuestions, // Mengirimkan array berisi semua pertanyaan
            'success' => 'Pertanyaan bundle berhasil dibuat!',
        ]);
    }

    private function handleFileUpload(Request $request, $questionMediaGuid)
    {
        // Direktori untuk menyimpan file
        $imageDirectory = 'uploads/image/';
        $audioDirectory = 'uploads/audio/';

        // Proses file image
        if ($request->hasFile('imageFile')) {
            $imageFile = $request->file('imageFile');
            $imageName = $questionMediaGuid . '.' . $imageFile->getClientOriginalExtension();

            $imageFile->move(public_path($imageDirectory), $imageName);

            // Simpan metadata ke database
            Filemedia::updateOrCreate(
                ['name' => $imageName, 'type' => 'image'],
                ['questionmedia_id' => null, 'active' => true]
            );
        }

        // Proses file audio
        if ($request->hasFile('audioFile')) {
            $audioFile = $request->file('audioFile');
            $audioName = $questionMediaGuid . '.' . $audioFile->getClientOriginalExtension();

            $audioFile->move(public_path($audioDirectory), $audioName);

            // Simpan metadata ke database
            Filemedia::updateOrCreate(
                ['name' => $audioName, 'type' => 'audio'],
                ['questionmedia_id' => null, 'active' => true]
            );
        }
    }

    public function store_truefalse(Request $request)
    {
        if ($request->input('image')) {
            $request->validate([
                'imageFile' => 'required',
            ]);
        }

        if ($request->input('audio')) {
            $request->validate([
                'audioFile' => 'required',
            ]);
        }

        // Validasi data input
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'time' => 'nullable|integer',
            'encode' => 'required|boolean',
            'image' => 'required|boolean',
            'audio' => 'required|boolean',
            'imageFile' => 'nullable|file|mimes:png|max:2048', // Maksimum 2MB untuk file PNG
            'audioFile' => 'nullable|file|mimes:ogg,wav|max:2048', // Maksimum 2MB untuk file OGG atau WAV
            'answer' => 'required|boolean',
            'whyWrong' => 'nullable|string|max:255',
            'standards' => 'nullable|string|max:255',
            'scope' => 'required|boolean',
            'reward_type' => 'required|string|max:255',
            'reward_id' => 'nullable|integer',
            'reward_amount' => 'nullable|integer',
            'penalty_type' => 'required|string|max:255',
            'penalty_id' => 'nullable|integer',
            'penalty_amount' => 'nullable|integer',
        ]);

        $correctAnswer = $validatedData['answer'];
        $question = [
            'Note' => 'Add note here',
            'GUID' => 'MZQ-' . strtolower(($this->guidRand() . '-' . $this->guidRand() . "-" . $this->guidRand())),
            'E' => $validatedData['encode'],
            'Q_T' => '9',
            'Q' => $validatedData['question'],
            'T' => $validatedData['time'] ? $validatedData['time'] * 60 : '0',
            'I' => $validatedData['image'],
            'A' => $validatedData['audio'],
            'C_A' => ($correctAnswer == '0') ?  $correctAnswer += rand(1, 1000) : $correctAnswer += rand(1001, 2000),
            'S' => $validatedData['standards'] ?? '',
            'R_T' => $validatedData['reward_type'],
            'R_I' => $validatedData['reward_id']  ?? '0',
            'R_A' => $validatedData['reward_amount']  ?? '0',
            'P_T' => $validatedData['penalty_type'],
            'P_I' => $validatedData['penalty_id']  ?? '0',
            'P_A' => $validatedData['penalty_amount']  ?? '0',
            'O_L' => $validatedData['scope'],
            'A2_Why' => $validatedData['whyWrong'] ?? '',
        ];

        // Panggil fungsi handleFileUpload jika ada input file
        if (isset($validatedData['imageFile']) || isset($validatedData['audioFile'])) {
            $this->handleFileUpload($request, $question['GUID']);
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return view('./builder/created', [
            'title' => 'Question Created',
            'question' => $question,
            'success' => 'Pertanyaan berhasil dibuat!',
        ]);
    }

    public function store_multichoice(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'time' => 'nullable|integer',
            'encode' => 'required|boolean',
            'image' => 'required|boolean',
            'audio' => 'required|boolean',
            'imageFile' => 'nullable|file|mimes:png|max:2048', // Maksimum 2MB untuk file PNG
            'audioFile' => 'nullable|file|mimes:ogg,wav|max:2048', // Maksimum 2MB untuk file OGG atau WAV
            'answer' => 'required|string|max:255',
            'answer_2' => 'required|string|max:255',
            'why_a2' => 'nullable|string|max:255',
            'answer_3' => 'nullable|string|max:255',
            'why_a3' => 'nullable|string|max:255',
            'answer_4' => 'nullable|string|max:255',
            'why_a4' => 'nullable|string|max:255',
            'answer_5' => 'nullable|string|max:255',
            'why_a5' => 'nullable|string|max:255',
            'standards' => 'nullable|string|max:255',
            'scope' => 'required|boolean',
            'reward_type' => 'required|string|max:255',
            'reward_id' => 'nullable|integer',
            'reward_amount' => 'nullable|integer',
            'penalty_type' => 'required|string|max:255',
            'penalty_id' => 'nullable|integer',
            'penalty_amount' => 'nullable|integer',
        ]);

        $Q_T = '2';
        if ($validatedData['answer_3']) {
            $Q_T = '3';
            if ($validatedData['answer_4']) {
                $Q_T = '4';
                if ($validatedData['answer_5']) {
                    $Q_T = '5';
                }
            }
        }
        $question = [
            'Note' => 'Add note here',
            'GUID' => 'MZQ-' . strtolower(($this->guidRand() . '-' . $this->guidRand() . "-" . $this->guidRand())),
            'E' => $validatedData['encode'],
            'Q_T' => $Q_T,
            'Q' => $validatedData['question'],
            'T' => $validatedData['time'] ? $validatedData['time'] * 60 : '0',
            'I' => $validatedData['image'],
            'A' => $validatedData['audio'],
            'C_A' => $validatedData['answer'],
            'A2' => $validatedData['answer_2'],
            'A2_Why' => $validatedData['why_a2'] ?? '',
            'A3' => $validatedData['answer_3'] ?? '',
            'A3_Why' => $validatedData['why_a3'] ?? '',
            'A4' => $validatedData['answer_4'] ?? '',
            'A4_Why' => $validatedData['why_a4'] ?? '',
            'A5' => $validatedData['answer_5'] ?? '',
            'A5_Why' => $validatedData['why_a5'] ?? '',
            'S' => $validatedData['standards'] ?? '',
            'R_T' => $validatedData['reward_type'],
            'R_I' => $validatedData['reward_id']  ?? '0',
            'R_A' => $validatedData['reward_amount']  ?? '0',
            'P_T' => $validatedData['penalty_type'],
            'P_I' => $validatedData['penalty_id']  ?? '0',
            'P_A' => $validatedData['penalty_amount']  ?? '0',
            'O_L' => $validatedData['scope'],
        ];

        // Panggil fungsi handleFileUpload jika ada input file
        if (isset($validatedData['imageFile']) || isset($validatedData['audioFile'])) {
            $this->handleFileUpload($request, $question['GUID']);
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return view('./builder/created', [
            'title' => 'Question Created',
            'question' => $question,
            'success' => 'Pertanyaan berhasil dibuat!',
        ]);
    }

    public function store_shortanswer(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'time' => 'nullable|integer',
            'encode' => 'required|boolean',
            'image' => 'required|boolean',
            'audio' => 'required|boolean',
            'imageFile' => 'nullable|file|mimes:png|max:2048', // Maksimum 2MB untuk file PNG
            'audioFile' => 'nullable|file|mimes:ogg,wav|max:2048', // Maksimum 2MB untuk file OGG atau WAV
            'answer' => 'required|string|max:255',
            'sensitive' => 'required|boolean',
            'standards' => 'nullable|string|max:255',
            'scope' => 'required|boolean',
            'reward_type' => 'required|string|max:255',
            'reward_id' => 'nullable|integer',
            'reward_amount' => 'nullable|integer',
            'penalty_type' => 'required|string|max:255',
            'penalty_id' => 'nullable|integer',
            'penalty_amount' => 'nullable|integer',
        ]);

        $question = [
            'Note' => 'Add note here',
            'GUID' => 'MZQ-' . strtolower(($this->guidRand() . '-' . $this->guidRand() . "-" . $this->guidRand())),
            'E' => $validatedData['encode'],
            'Q_T' => '1',
            'T' => $validatedData['time'] ? $validatedData['time'] * 60 : '0',
            'Q' => $validatedData['question'],
            'I' => $validatedData['image'],
            'C_A' => $validatedData['answer'],
            'C_S' => $validatedData['sensitive'],
            'S' => $validatedData['standards'] ?? '',
            'R_T' => $validatedData['reward_type'],
            'R_I' => $validatedData['reward_id']  ?? '0',
            'R_A' => $validatedData['reward_amount']  ?? '0',
            'P_T' => $validatedData['penalty_type'],
            'P_I' => $validatedData['penalty_id']  ?? '0',
            'P_A' => $validatedData['penalty_amount']  ?? '0',
            'O_L' => $validatedData['scope'],
        ];

        // Panggil fungsi handleFileUpload jika ada input file
        if (isset($validatedData['imageFile']) || isset($validatedData['audioFile'])) {
            $this->handleFileUpload($request, $question['GUID']);
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return view('./builder/created', [
            'title' => 'Question Created',
            'question' => $question,
            'success' => 'Pertanyaan berhasil dibuat!',
        ]);
    }

    private function guidRand()
    {
        return substr(dechex((1 + mt_rand() / mt_getrandmax()) * 0x10000), 1, 4);
    }
}
