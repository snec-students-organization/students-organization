<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ActivityLog;

class ActivityLogSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        if ($admin) {
            ActivityLog::create([
    'user_id' => $admin->id,  // ✅ Use numeric PK
    'description' => 'Initial activity log'
]);

        }
    }
}
