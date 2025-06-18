<?php

namespace Database\Seeders;

use App\Models\Questionmedia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionmediasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questionmedia::create([
            'guid' => 'MZQ-5e9f-0227-d9cb',
            'question' => 'Siapa nama presiden pertama Indonesia?',
            'image' => 1,
            'audio' => 0,
            'sheetname_id' => 3,
        ]);

        Questionmedia::create([
            'guid' => 'MZQ-183a-94ec-491a',
            'question' => '䷊䷅䷨䷟䷴䷯䷖䷫䷠䷋䷉䷟䷀䷍䷆䷩䷁䷝䷔䷟䷴䷅䷎䷿䷠䷌䷙䷚䷁䷝䷰䷜䷇䷒䷙䷫䷱䷓䷺䷮䷱䷓䷥䷟䷀䷮䷙䷹䷄䷪䷙䷊䷁䷓䷔䷟䷠䷎䷥䷉䷀䷍䷜䷟䷘䷩==',
            'image' => 1,
            'audio' => 0,
            'sheetname_id' => 1,
        ]);

        Questionmedia::create([
            'guid' => 'MZQ-9a34-283f-f031',
            'question' => 'Dengarkan suara ini. Ini adalah suara pesawat terbang saat lepas landas.',
            'image' => 0,
            'audio' => 1,
            'sheetname_id' => 1,
        ]);

        Questionmedia::create([
            'guid' => 'MZQ-54dc-4a70-45ec',
            'question' => 'Proklamasi Kemerdekaan Indonesia dibacakan pada tanggal?',
            'image' => 1,
            'audio' => 0,
            'sheetname_id' => 2,
        ]);

        Questionmedia::create([
            'guid' => 'MZQ-2699-b5cc-5a80',
            'question' => 'Dengarkan suara berikut ini dan tentukan suara alat musik apa yang dimainkan:',
            'image' => 0,
            'audio' => 1,
            'sheetname_id' => 2,
        ]);
    }
}
