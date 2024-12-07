<?php

namespace Database\Seeders;

use App\Models\Group;
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

        Group::create([
            'code' => '1',
            'name' => 'Aset'
        ]);

        Group::create([
            'code' => '2',
            'name' => 'Liabilitas'
        ]);

        Group::create([
            'code' => '3',
            'name' => 'Ekuitas'
        ]);

        Group::create([
            'code' => '4',
            'name' => 'Pendapatan'
        ]);

        Group::create([
            'code' => '5',
            'name' => 'Beban'
        ]);
    }
}
