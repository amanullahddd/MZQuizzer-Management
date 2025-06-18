<?php

namespace Database\Seeders;

use App\Models\Sheetname;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SheetnamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sheetname::create([
            'name' => 'TrueFalse',
            // 'slug' => 'truefalse',
            'spreadsheet_id' => 1,
            'active' => 1,
        ]);

        Sheetname::create([
            'name' => 'MultiChoice',
            // 'slug' => 'multichoice',
            'spreadsheet_id' => 1,
            'active' => 1,
        ]);

        Sheetname::create([
            'name' => 'ShortAnswer',
            // 'slug' => 'shortanswer',
            'spreadsheet_id' => 1,
            'active' => 1,
        ]);

        // Sheetname::create([
        //     'name' => 'TrueFalse',
        //     // 'slug' => 'truefalse',
        //     'spreadsheet_id' => 2,
        //     'active' => 1,
        // ]);

        // Sheetname::create([
        //     'name' => 'Sheet5',
        //     // 'slug' => 'sheet5',
        //     'spreadsheet_id' => 2,
        //     'active' => 1,
        // ]);

        // Sheetname::create([
        //     'name' => 'Sheet1',
        //     // 'slug' => 'sheet1',
        //     'spreadsheet_id' => 3,
        //     'active' => 1,
        // ]);

        // Sheetname::create([
        //     'name' => 'Sheet2',
        //     // 'slug' => 'sheet2',
        //     'spreadsheet_id' => 3,
        //     'active' => 1,
        // ]);
    }
}
