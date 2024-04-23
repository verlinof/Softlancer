<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role' => 'Front end'],
            ['role' => 'Back end'],
            ['role' => 'Full stack'],
            ['role' => 'Mobile Developer'],
            ['role' => 'UI/UX Designer'],
            ['role' => 'Data Scientist'],
            ['role' => 'DevOps'],
            ['role' => 'Machine Learning Engineer'],
            ['role' => 'Game Developer'],
            ['role' => 'Data Analyst'],
            ['role' => 'Data Engineer'],
            ['role' => 'AI Engineer'],
            ['role' => 'Cyber Security'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
