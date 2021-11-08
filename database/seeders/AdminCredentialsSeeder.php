<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;



class AdminCredentialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'admin@test.com',
        ]);
    }
}
