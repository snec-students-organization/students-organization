<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 use App\Models\Institution;
class InstitutionSeeder extends Seeder
{
  

public function run()
{
    Institution::firstOrCreate(
        ['email' => 'demo1@example.com'],
        ['name' => 'Demo Institution 1', 'password' => bcrypt('password123')]
    );

    Institution::firstOrCreate(
        ['email' => 'demo2@example.com'],
        ['name' => 'Demo Institution 2', 'password' => bcrypt('password123')]
    );
    Institution::firstOrCreate(
        ['email' => 'demo3@example.com'],
        ['name' => 'Demo Institution 3', 'password' => bcrypt('password123')]
    );
}

}
