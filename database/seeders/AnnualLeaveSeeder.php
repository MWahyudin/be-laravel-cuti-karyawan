<?php

namespace Database\Seeders;

use App\Models\AnnualLeave;
use Illuminate\Database\Seeder;

class AnnualLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnnualLeave::factory()->count(100)->create();
    }
}
