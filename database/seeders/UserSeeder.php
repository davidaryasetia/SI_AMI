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
            'nama' => 'Hary Oktavianto',
            'nip' => 1970121001,
            'status_admin' => true,
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('hary'),
        ]);
        User::create([ // 2
            
            'nama' => 'Nana Ramadijanti',
            'nip' => 1974521002,
            'status_admin' => true,
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('nana'),
        ]);
        User::create([ // 3
            
            'nama' => 'Tita Karlita',
            'nip' => 1985521003,
            'status_admin' => true,
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([ // 4
            
            'nama' => 'Fitri Setyorini',
            'nip' => 1970521004,
            'status_admin' => false,
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('fitri'),
        ]);
        User::create([ // 5
            
            'nama' => 'Selvia',
            'nip' => 1970521005,
            'status_admin' => false,
            'email' => 'Selvia@pens.ac.id',
            'password' => bcrypt('selvia'),
        ]);
        User::create([ // 6
            
            'nama' => 'Wenny Mistarika',
            'nip' => 1970521006,
            'status_admin' => false,
            'email' => 'weny@pens.ac.id',
            'password' => bcrypt('wenny'),
        ]);
        User::create([ // 7
          
            'nama' => 'Fitrah Maharani',
            'nip' => 1970521007,
            'status_admin' => false,
            'email' => 'fitra@pens.ac.id',
            'password' => bcrypt('fitrah'),
        ]);


        // ----------- Departement Teknik Elektronika --------------------//
        User::create([ // 8
            
            'nama' => 'John',
            'nip' => 1970221,
            'status_admin' => false,
            'email' => 'john@pens.ac.id',
            'password' => bcrypt('john'),
        ]);
        User::create([ // 9
            
            'nama' => 'Elly Purwantini',
            'nip' => 1970521021,
            'status_admin' => false,
            'email' => 'elly@pens.ac.id',
            'password' => bcrypt('elly'),
        ]);
        User::create([ // 10
           
            'nama' => 'Elizabeth Anggraeni',
            'nip' => 197052102,
            'status_admin' => false,
            'email' => 'ellizabeth@pens.ac.id',
            'password' => bcrypt('elizabeth'),
        ]);
        User::create([ // 11
           
            'nama' => 'Dedid Cahya',
            'nip' => 1970521023,
            'status_admin' => false,
            'email' => 'dedid@pens.ac.id',
            'password' => bcrypt('dedid'),
        ]);
        User::create([ // 12
          
            'nama' => 'Wahjoe Tjatur',
            'nip' => 1970521024,
            'status_admin' => false,
            'email' => 'wahjoe@pens.ac.id',
            'password' => bcrypt('wahjoe'),
        ]);
        // ------------- Departement Teknik Elektronika -------------------//



        // ------------- Departement Teknik Informatika -------------------//
        User::create([ // 13
           
            'nama' => 'Purwanto',
            'nip' => 197323,
            'status_admin' => false,
            'email' => 'purwanto@pens.ac.id',
            'password' => bcrypt('purwanto'),
        ]);

        User::create([ // 14
            
            'nama' => 'Nur Rosyid Mubtadai',
            'nip' => 1970521031,
            'status_admin' => false,
            'email' => 'rosyid@pens.ac.id',
            'password' => bcrypt('rosyid'),
        ]);

        User::create([ // 15
           
            'nama' => 'Syauqi Ahmad Ahsan',
            'nip' => 1970521039,
            'status_admin' => false,
            'email' => 'syauqi@pens.ac.id',
            'password' => bcrypt('syauqi'),
        ]);

        User::create([ // 16
            
            'nama' => 'Riyanto Sigit',
            'nip' => 1970521032,
            'status_admin' => false,
            'email' => 'riyanto@pens.ac.id',
            'password' => bcrypt('riyanto'),
        ]);

        User::create([ // 17
           
            'nama' => 'Iwan Syarif',
            'nip' => 1970521025,
            'status_admin' => false,
            'email' => 'iwan@pens.ac.id',
            'password' => bcrypt('iwan'),
        ]);
        // ------------- Departement Teknik Informatika -------------------//



        // ------------- Departement Teknik Mekanika Energi --------------//
        User::create([ // 18
            
            'nama' => 'Purwo',
            'nip' => 19721037,
            'status_admin' => false,
            'email' => 'purwo@pens.ac.id',
            'password' => bcrypt('purwo'),
        ]);
        User::create([ // 19
            
            'nama' => 'Endra Pitowarno',
            'nip' => 1970521037,
            'status_admin' => false,
            'email' => 'endra@pens.ac.id',
            'password' => bcrypt('endra'),
        ]);

        User::create([ // 20

            'nama' => 'Indra Adji',
            'nip' => 1970521135,
            'status_admin' => false,
            'email' => 'indra@pens.ac.id',
            'password' => bcrypt('indra'),
        ]);
        // ------------- Departement Teknik Mekanika Energi --------------//
    }
}
