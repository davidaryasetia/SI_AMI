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
            'unit_branch_id' => NULL,  
            'nama' => 'Hary Oktavianto',
            'nip' => 1970121001,
            'status_admin' => true,
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('hary'),
        ]);
        User::create([
            'unit_id' => 2,
            'unit_branch_id' => NULL,  
            'nama' => 'Nana Ramadijanti',
            'nip' => 1974521002,
            'status_admin' => true,
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('nana'),
        ]);
        User::create([
            'unit_id' => 3,
            'unit_branch_id' => NULL,  
            'nama' => 'Tita Karlita',
            'nip' => 1985521003,
            'status_admin' => true,
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([
            'unit_id' => 4,
            'unit_branch_id' => NULL,  
            'nama' => 'Fitri Setyorini',
            'nip' => 1970521004,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('fitri'),
        ]);
        User::create([
            'unit_id' => 5,
            'unit_branch_id' => NULL,  
            'nama' => 'Selvia',
            'nip' => 1970521005,
            'status_admin' => false,
            'email' => 'Selvia@pens.ac.id',
            'password' => bcrypt('selvia'),
        ]);
        User::create([
            'unit_id' => 6,
            'unit_branch_id' => NULL,  
            'nama' => 'Wenny Mistarika',
            'nip' => 1970521006,
            'status_admin' => false,
            'email' => 'wenny@pens.ac.id',
            'password' => bcrypt('wenny'),
        ]);
        User::create([
            'unit_id' => 7,
            'unit_branch_id' => NULL,  
            'nama' => 'Fitrah Maharani',
            'nip' => 1970521007,
            'status_admin' => false,
            'email' => 'fitra@pens.ac.id',
            'password' => bcrypt('fitrah'),
        ]);

        // 'unit_branch_id' => '' (kepala)
        User::create([
            'unit_id' => 8,
            'unit_branch_id' => NULL, 
            'nama' => 'Elly Purwantini',
            'nip' => 1970521021,
            'status_admin' => false,
            'email' => 'elly@pens.ac.id',
            'password' => bcrypt('elly'),
        ]);
        User::create([
            'unit_id' => 8,
            'unit_branch_id' => 1, 
            'nama' => 'Elizabeth Anggraeni',
            'nip' => 197052102,
            'status_admin' => false,
            'email' => 'ellizabeth@pens.ac.id',
            'password' => bcrypt('elizabeth'),
        ]);
        User::create([
            'unit_id' => 8,
            'unit_branch_id' => 2, 
            'nama' => 'Dedid Cahya',
            'nip' => 1970521023,
            'status_admin' => false,
            'email' => 'dedid@pens.ac.id',
            'password' => bcrypt('dedid'),
        ]);
        User::create([
            'unit_id' => 8,
            'unit_branch_id' => 3, 
            'nama' => 'Wahjoe Tjatur',
            'nip' => 1970521024,
            'status_admin' => false,
            'email' => 'wahjoe@pens.ac.id',
            'password' => bcrypt('wahjoe'),
        ]);


            // 'unit_branch_id' => ''
        User::create([
            'unit_id' => 9,
            'unit_branch_id' => NULL, 
            'nama' => 'Nur Rosyid Mubtadai',
            'nip' => 1970521031,
            'status_admin' => false,
            'email' => 'rosyid@pens.ac.id',
            'password' => bcrypt('rosyid'),
        ]);
        User::create([
            'unit_id' => 9,
            'unit_branch_id' => 7, 
            'nama' => 'Syauqi Ahmad Ahsan',
            'nip' => 1970521039,
            'status_admin' => false,
            'email' => 'syauqi@pens.ac.id',
            'password' => bcrypt('syauqi'),
        ]);
        User::create([
            'unit_id' => 9,
            'unit_branch_id' => 8, 
            'nama' => 'Riyanto Sigit',
            'nip' => 1970521032,
            'status_admin' => false,
            'email' => 'riyanto@pens.ac.id',
            'password' => bcrypt('riyanto'),
        ]);
        User::create([
            'unit_id' => 9,
            'unit_branch_id' => 9, 
            'nama' => 'Iwan Syarif',
            'nip' => 1970521033,
            'status_admin' => false,
            'email' => 'iwan@pens.ac.id',
            'password' => bcrypt('iwan'),
        ]);


        
    }
}
