<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // User
         User::create([
            'unit_id' => 1,
            'nama' => 'Hary Oktavianto',
            'nip' => 1970121001,
            'status_admin' => true,
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('hary'),
        ]);
        User::create([
            'unit_id' => 2,
            'nama' => 'Nana Ramadijanti',
            'nip' => 1974521002,
            'status_admin' => true,
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('nana'),
        ]);
        User::create([
            'unit_id' => 3,
            'nama' => 'Tita Karlita',
            'nip' => 1985521003,
            'status_admin' => true,
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 4,
            'nama' => 'Fitri Setyorini',
            'nip' => 1970521004,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 5,
            'nama' => 'Selvia',
            'nip' => 1970521005,
            'status_admin' => false,
            'email' => 'Selvia@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 6,
            'nama' => 'Wenny Mistarika',
            'nip' => 1970521006,
            'status_admin' => false,
            'email' => 'wenny@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 7,
            'nama' => 'Fitrah Maharani',
            'nip' => 1970521007,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 8,
            'nama' => 'Fitri Setyorini',
            'nip' => 1970521001,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);

    }
}
