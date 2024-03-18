<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_type;
use App\Models\Rol;
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

        Rol::create([
            'name' => 'Socio',
        ]);

        Rol::create([
            'name' => 'Farmacéutico',
        ]);
        User_type::create([
            'name' => 'Socio',
            'rol' => Rol::where('name', 'Socio')->get()->first()['id'],
        ]);

        User_type::create([
            'name' => 'Farmacéutico',
            'rol' => Rol::where('name', 'Farmacéutico')->get()->first()['id'],
        ]);

        User::factory()->create([
            'name' => 'Federico Kronhaus',
            'email' => 'federicokronhaus@gmail.com',
            'password' => bcrypt('1234'),
            'user_type' => User_type::where('name', 'Farmacéutico')->get()->first()['id'],
        ]);
    }
}
