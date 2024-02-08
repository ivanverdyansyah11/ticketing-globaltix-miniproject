<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'Balinese',
        ]);

        Language::create([
            'name' => 'Bahasa Java',
        ]);

        Language::create([
            'name' => 'Bahasa Komodo',
        ]);

        Language::create([
            'name' => 'Bahasa Papua',
        ]);
    }
}