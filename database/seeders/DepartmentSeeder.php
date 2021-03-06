<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department')->insert([
            ['department' => 'HR'],
            ['department' => 'Training'],
            ['department' => 'Finance'],
            ['department' => 'Sales'],
            ['department' => 'Development']
        ]);
    }
}
