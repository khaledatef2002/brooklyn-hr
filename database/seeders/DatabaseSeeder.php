<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = User::create([
            'first_name' => 'khaled',
            'last_name' => 'atef',
            'email' => 'khaledatef312@gmail.com',
            'password' => bcrypt('123456789'),
            'date_of_birth' => '2002-12-24',
            'phone_number' => '01010419841',
        ]);
        $user->assignRole('manager');

    }
}
