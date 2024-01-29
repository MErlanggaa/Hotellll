<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Kamar::factory(3)->create();
    }
}
