<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::factory()
            ->count(3)
            ->has(Doctor::factory()->count(2))
            ->create();
    }
}
