<?php

namespace Database\Seeders\Sample;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $samplePath = base_path() . '/storage/sample';
        $filesInFolder = File::allFiles($samplePath);

        foreach ($filesInFolder as $file) {
            $sql = file_get_contents($file->getPathname());
            DB::unprepared($sql);
        }
    }
}
