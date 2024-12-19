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
        User::create([  // 1
            'nama' => 'Ahmad Zaki',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'ahmad@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 2
            'nama' => 'Aliridho Barakbah',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'aliridho@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 3
            'nama' => 'Amang Sudarsono',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'amang@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 4
            'nama' => 'Andri Suryandari',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'andri@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 5
            'nama' => 'Ardik Wijayanto',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'ardik@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 6
            'nama' => 'Ari Wijayanti',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'ari@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 7
            'nama' => 'Aries Pratiarso',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'aries@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 8
            'nama' => 'Arna Fariza',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'arna@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 9
            'nama' => 'Ashafidz Fauzan',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'ashafidz@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 10
            'nama' => 'Bambang Sumantri',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'bambang@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 11
            'nama' => 'Bima Sena Bayu Dewantara',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'bima@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 12
            'nama' => 'Budi Nur Iman',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'budi@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 13
            'nama' => 'Didik SP',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'didiksp@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 14
            'nama' => 'Didik Setyo Purnomo',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'didik@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 15
            'nama' => 'Dimas Okky Anggriawan',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'dimas@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 16
            'nama' => 'Dwi Susanto',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'dwi@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 17
            'nama' => 'Eko Henfri Binugroho',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'eko@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 18
            'nama' => 'Entin Martiana',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'entin@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 19
            'nama' => 'Eny Kusumawati',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'eny@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 20
            'nama' => 'Era Purwanto',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'era@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 21
            'nama' => 'Hani\'ah Mahmudah',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'hani@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 22
            'nama' => 'Hary Oktavianto',
            'is_admin' => true,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'hary@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 23
            'nama' => 'I Gede Puja Astawa',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'gede@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 24
            'nama' => 'Idris Winarno',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'idris@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 25
            'nama' => 'Ira Prasetyaningrum',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'ira@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 26
            'nama' => 'Isbat Uzzin N',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'isbat@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 27
            'nama' => 'Iwan Syarif',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'iwan@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 28
            'nama' => 'Joke Pratilastiarso',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'joke@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 29
            'nama' => 'Kholid Fathoni',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'kholid@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 30
            'nama' => 'Lucky Pradigta Setiya Raharja',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'lucky@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 31
            'nama' => 'M. Rochmad',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'mrochmad@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 32
            'nama' => 'M. Safrodin',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'msafrodin@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 33
            'nama' => 'M. Udin Harun Al Rasyid',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'udin@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 34
            'nama' => 'M. Zen Samsono',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'zen@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 35
            'nama' => 'Mike Yuliana',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'mike@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 36
            'nama' => 'Mu\'arifin',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'mua@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 37
            'nama' => 'Muh Agus Zainuddin',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'muh@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 38
            'nama' => 'Nana Ramadijanti',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'nana@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 39
            'nama' => 'Novian Fajar Satria',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'novian@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 40
            'nama' => 'Pindharwati Bandiannaningsih',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'pindharwati@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 41
            'nama' => 'Reesa Akbar',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'reesa@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 42
            'nama' => 'Rengga Asmara',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'rengga@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 43
            'nama' => 'Rif\'ah Amalia',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'rifah@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 44
            'nama' => 'Rika Rokhana',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'rika@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 45
            'nama' => 'Ronny Susetyoko',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'ronny@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 46
            'nama' => 'Rusminto Tjatur Widodo',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'rusminto@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 47
            'nama' => 'Sritrusta Sukaridhoto',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'sritrusta@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 48
            'nama' => 'Sulistyani',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'sulistyani@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 49
            'nama' => 'Suria Hardita Duanti Putri',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'suria@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 50
            'nama' => 'Suryono',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'suryono@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 51
            'nama' => 'Sutikno',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'sutikno@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 52
            'nama' => 'Taufiqurrahman',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'taufiqurrahman@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 53
            'nama' => 'Tita Karlita',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'tita@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 54
            'nama' => 'Tri Budi Santoso',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'tribudi@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 55
            'nama' => 'Tri Harsono',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'triharsono@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 56
            'nama' => 'Trihadiah Mulia',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'trihadiah@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 57
            'nama' => 'Wiratmoko Yuwono',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'wiratmoko@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 58
            'nama' => 'Yeni Suryani',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'yeni@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
        User::create([  // 59
            'nama' => 'Zaqiatud Darojah',
            'is_admin' => false,
            'is_audite' => false,
            'is_auditor' => false,
            'email' => 'zaqiatud@pens.ac.id',
            'password' => bcrypt('1234'),
        ]);
    }
}
