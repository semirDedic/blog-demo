<?php

namespace Database\Seeders;

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
            RolesAndPermissionsSeeder::class,
        ]);

        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->assignRole('member');
        });

        \App\Models\User::factory()->super()->create([
            'name' => 'Super User',
            'email' => 'super_admin@example.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
