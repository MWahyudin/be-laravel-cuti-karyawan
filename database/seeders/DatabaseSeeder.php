<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User role
        Role::create(['role' => 'superadmin']);
        Role::create(['role' => 'staff hr']);
        Role::create(['role' => 'karyawan']);
        //Data seeder
        $this->call([
            UserSeeder::class,
            AnnualLeaveSeeder::class,
            // CommentSeeder::class,
        ]);
    }
}
