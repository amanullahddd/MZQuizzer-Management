<?php

namespace Database\Seeders;

use App\Models\Spreadsheet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpreadsheetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Spreadsheet::create([
            'title' => 'questionDatabase_1',
            // 'slug' => 'question-database-1',
            'description' => 'Bank Soal 1.',
            'documentId' => '1Io81lM5dioA-W_fYIHykpZykv6cn4nJoE3zC91YXbvs',
            'apiKey' => 'AIzaSyAp7KA6ci_LYRv7ONoNy0bXgnjlgzHKsyA',
            'token' => '654321',
            'active' => 1,
        ]);

        // Spreadsheet::create([
        //     'title' => 'questionDatabase_2',
        //     // 'slug' => 'question-database-2',
        //     'description' => 'Bank Soal 2.',
        //     'documentId' => '1T2svd-Xds4Uza5Q_pjg_p4I_XiOytZOKyuextnQv6xo',
        //     'apiKey' => 'AIzaSyAp7KA6ci_LYRv7ONoNy0bXgnjlgzHKsyA',
        //     'token' => '123456',
        //     'active' => 0,
        // ]);

        // Spreadsheet::create([
        //     'title' => 'Untitled spreadsheet',
        //     // 'slug' => 'untitled-spreadsheet',
        //     'description' => 'document uji coba',
        //     'documentId' => '1OvorbmtaMQQEV3wtkv7WrOwwT_-nTSo9HqH-FD9oViI',
        //     'apiKey' => 'AIzaSyAp7KA6ci_LYRv7ONoNy0bXgnjlgzHKsyA',
        //     'token' => 'uqVGXf',
        //     'active' => 0,
        // ]);
    }
}
