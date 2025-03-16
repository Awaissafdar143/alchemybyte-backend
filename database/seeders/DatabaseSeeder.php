<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        BlogSeeder::class,
        SeoSeeder::class,
      ]);

        User::factory()->create([
            'name' => "Awais Safdar",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin'),
        ]);
    }
}
