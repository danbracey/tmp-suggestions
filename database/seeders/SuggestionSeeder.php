<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Suggestion::factory()->create([
            'name' => 'Replace trucks with penguins'
            //Rest of this is generated by Factory
        ]);
    }
}
