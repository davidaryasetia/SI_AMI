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
        User::create([  // 1
            'unit_id' => 1, // Ukarni
            'unit_cabang_id' => NULL,
            'nama' => 'Hary Oktavianto',
            'nip' => 1970121001,
            'status_admin' => true,
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('hary'),
        ]);
        User::create([ // 2
            'unit_id' => 2, // P3M
            'unit_cabang_id' => NULL,
            'nama' => 'Nana Ramadijanti',
            'nip' => 1974521002,
            'status_admin' => true,
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('nana'),
        ]);
        User::create([ // 3
            'unit_id' => 3, // Penalaran
            'unit_cabang_id' => NULL,
            'nama' => 'Tita Karlita',
            'nip' => 1985521003,
            'status_admin' => true,
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([ // 4
            'unit_id' => 4, // Minat Bakat
            'unit_cabang_id' => NULL,
            'nama' => 'Fitri Setyorini',
            'nip' => 1970521004,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('fitri'),
        ]);
        User::create([ // 5
            'unit_id' => 5, // Perencanaa
            'unit_cabang_id' => NULL,
            'nama' => 'Selvia',
            'nip' => 1970521005,
            'status_admin' => false,
            'email' => 'Selvia@pens.ac.id',
            'password' => bcrypt('selvia'),
        ]);
        User::create([ // 6
            'unit_id' => 6, // P4MP Pembelajran
            'unit_cabang_id' => NULL,
            'nama' => 'Wenny Mistarika',
            'nip' => 1970521006,
            'status_admin' => false,
            'email' => 'weny@pens.ac.id',
            'password' => bcrypt('wenny'),
        ]);
        User::create([ // 7
            'unit_id' => 7, // P4MP SPM
            'unit_cabang_id' => NULL,
            'nama' => 'Fitrah Maharani',
            'nip' => 1970521007,
            'status_admin' => false,
            'email' => 'fitra@pens.ac.id',
            'password' => bcrypt('fitrah'),
        ]);


        // ----------- Departement Teknik Elektronika --------------------//
        User::create([ // 8
            'unit_id' => 8, // Departemen Teknik Elektronika
            'unit_cabang_id' => NULL, // D4 Teknik Elektronika
            'nama' => 'John',
            'nip' => 1970221,
            'status_admin' => false,
            'email' => 'john@pens.ac.id',
            'password' => bcrypt('john'),
        ]);
        User::create([ // 8
            'unit_id' => 8, // Departemen Teknik Elektronika
            'unit_cabang_id' => 1, // D4 Teknik Elektronika
            'nama' => 'Elly Purwantini',
            'nip' => 1970521021,
            'status_admin' => false,
            'email' => 'elly@pens.ac.id',
            'password' => bcrypt('elly'),
        ]);
        User::create([ // 9
            'unit_id' => 8, // Departemnen Teknik Elektronika
            'unit_cabang_id' => 2, // D3 Teknik Elektronika
            'nama' => 'Elizabeth Anggraeni',
            'nip' => 197052102,
            'status_admin' => false,
            'email' => 'ellizabeth@pens.ac.id',
            'password' => bcrypt('elizabeth'),
        ]);
        User::create([ // 10
            'unit_id' => 8, // Departement Teknik Elektronika 
            'unit_cabang_id' => 3, // D3 Teknik Telekomunikasi
            'nama' => 'Dedid Cahya',
            'nip' => 1970521023,
            'status_admin' => false,
            'email' => 'dedid@pens.ac.id',
            'password' => bcrypt('dedid'),
        ]);
        User::create([ // 11
            'unit_id' => 8, // Departement Teknik Elektronika
            'unit_cabang_id' => 4, // D4 Teknik Telekomunikasi
            'nama' => 'Wahjoe Tjatur',
            'nip' => 1970521024,
            'status_admin' => false,
            'email' => 'wahjoe@pens.ac.id',
            'password' => bcrypt('wahjoe'),
        ]);
        // ------------- Departement Teknik Elektronika -------------------//



        // ------------- Departement Teknik Informatika -------------------//
        User::create([ // 12
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => null, // D4 Teknik Informatika
            'nama' => 'Purwanto',
            'nip' => 197323,
            'status_admin' => false,
            'email' => 'purwanto@pens.ac.id',
            'password' => bcrypt('purwanto'),
        ]);

        User::create([ // 12
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 7, // D4 Teknik Informatika
            'nama' => 'Nur Rosyid Mubtadai',
            'nip' => 1970521031,
            'status_admin' => false,
            'email' => 'rosyid@pens.ac.id',
            'password' => bcrypt('rosyid'),
        ]);

        User::create([ // 13
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 8, // D3 Teknik Informatika
            'nama' => 'Syauqi Ahmad Ahsan',
            'nip' => 1970521039,
            'status_admin' => false,
            'email' => 'syauqi@pens.ac.id',
            'password' => bcrypt('syauqi'),
        ]);

        User::create([ // 14
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 9, // D4 Teknik Komputer
            'nama' => 'Riyanto Sigit',
            'nip' => 1970521032,
            'status_admin' => false,
            'email' => 'riyanto@pens.ac.id',
            'password' => bcrypt('riyanto'),
        ]);

        User::create([ // 15
            'unit_id' => 9, // Departement Teknik Informatika
            'unit_cabang_id' => 10, // D4 Sains Data Terapan
            'nama' => 'Iwan Syarif',
            'nip' => 1970521025,
            'status_admin' => false,
            'email' => 'iwan@pens.ac.id',
            'password' => bcrypt('iwan'),
        ]);
        // ------------- Departement Teknik Informatika -------------------//



        // ------------- Departement Teknik Mekanika Energi --------------//
        User::create([ // 16
            'unit_id' => 10, // Departement Teknik Mekanika Energi
            'unit_cabang_id' => NULL, // D4 Teknik Mekatronika
            'nama' => 'Purwo',
            'nip' => 19721037,
            'status_admin' => false,
            'email' => 'purwo   @pens.ac.id',
            'password' => bcrypt('purwo'),
        ]);
        User::create([ // 16
            'unit_id' => 10, // Departement Teknik Mekanika Energi
            'unit_cabang_id' => 11, // D4 Teknik Mekatronika
            'nama' => 'Endra Pitowarno',
            'nip' => 1970521037,
            'status_admin' => false,
            'email' => 'endra@pens.ac.id',
            'password' => bcrypt('endra'),
        ]);

        User::create([ // 17
            'unit_id' => 10, // Departement Teknik Mekanika Energi
            'unit_cabang_id' => 12, // D4 Sistem Pembangkit Energi
            'nama' => 'Indra Adji',
            'nip' => 1970521135,
            'status_admin' => false,
            'email' => 'indra@pens.ac.id',
            'password' => bcrypt('indra'),
        ]);
        // ------------- Departement Teknik Mekanika Energi --------------//
    }
}
