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
            'is_admin' => true, 
            'is_audite' => true, 
            'is_auditor' => true,  
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('hary'),
        ]);
        User::create([ // 2
            
            'nama' => 'Nana Ramadijanti',
            'is_admin' => true, 
            'is_audite' => true,
            'is_auditor' => true,  
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('nana'),
        ]);
        User::create([ // 3
            
            'nama' => 'Tita Karlita',
            'is_admin' => true, 
            'is_audite' => true,
            'is_auditor' => true,  
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('tita'),
        ]);
        User::create([ // 4
            
            'nama' => 'Fitri Setyorini',
            'is_admin' => true, 
            'is_audite' => true,
            'is_auditor' => true,   
            'email' => 'fitri@pens.ac.id',
            'password' => bcrypt('fitri'),
        ]);
        User::create([ // 5
            
            'nama' => 'Selvia',
            'is_admin' => true, 
            'is_audite' => true,
            'is_auditor' => true,   
            'email' => 'Selvia@pens.ac.id',
            'password' => bcrypt('selvia'),
        ]);
        User::create([ // 6
            
            'nama' => 'Wenny Mistarika',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'weny@pens.ac.id',
            'password' => bcrypt('wenny'),
        ]);
        User::create([ // 7
          
            'nama' => 'Fitrah Maharani',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'fitra@pens.ac.id',
            'password' => bcrypt('fitrah'),
        ]);


        // ----------- Departement Teknik Elektronika --------------------//
        User::create([ // 8
            
            'nama' => 'John',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'john@pens.ac.id',
            'password' => bcrypt('john'),
        ]);
        User::create([ // 9
            
            'nama' => 'Elly Purwantini',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'elly@pens.ac.id',
            'password' => bcrypt('elly'),
        ]);
        User::create([ // 10
           
            'nama' => 'Elizabeth Anggraeni',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'ellizabeth@pens.ac.id',
            'password' => bcrypt('elizabeth'),
        ]);
        User::create([ // 11
           
            'nama' => 'Dedid Cahya',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'dedid@pens.ac.id',
            'password' => bcrypt('dedid'),
        ]);
        User::create([ // 12
          
            'nama' => 'Wahjoe Tjatur',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'wahjoe@pens.ac.id',
            'password' => bcrypt('wahjoe'),
        ]);
        // ------------- Departement Teknik Elektronika -------------------//



        // ------------- Departement Teknik Informatika -------------------//
        User::create([ // 13
           
            'nama' => 'Purwanto',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'purwanto@pens.ac.id',
            'password' => bcrypt('purwanto'),
        ]);

        User::create([ // 14
            
            'nama' => 'Nur Rosyid Mubtadai',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'rosyid@pens.ac.id',
            'password' => bcrypt('rosyid'),
        ]);

        User::create([ // 15
           
            'nama' => 'Syauqi Ahmad Ahsan',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'syauqi@pens.ac.id',
            'password' => bcrypt('syauqi'),
        ]);

        User::create([ // 16
            
            'nama' => 'Riyanto Sigit',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'riyanto@pens.ac.id',
            'password' => bcrypt('riyanto'),
        ]);

        User::create([ // 17
           
            'nama' => 'Iwan Syarif',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'iwan@pens.ac.id',
            'password' => bcrypt('iwan'),
        ]);
        // ------------- Departement Teknik Informatika -------------------//



        // ------------- Departement Teknik Mekanika Energi --------------//
        User::create([ // 18
            
            'nama' => 'Purwo',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'purwo@pens.ac.id',
            'password' => bcrypt('purwo'),
        ]);
        User::create([ // 19
            
            'nama' => 'Endra Pitowarno',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'endra@pens.ac.id',
            'password' => bcrypt('endra'),
        ]);

        User::create([ // 20

            'nama' => 'Indra Adji',
            'is_admin' => false, 
            'is_audite' => false,
            'is_auditor' => false,  
            'email' => 'indra@pens.ac.id',
            'password' => bcrypt('indra'),
        ]);
        // ------------- Departement Teknik Mekanika Energi --------------//
    }
}
