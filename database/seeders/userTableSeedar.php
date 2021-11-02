<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userTableSeedar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            
            'name' => 'maha',
            'email' => 'mshakthi019@gmail.com',
            'password' => Hash::make('ehrbehu')
        ]);
    }
}


// 'name' => 'maha',
// 'email' => 'mshakthi019@gmail.com',
// 'password' => Hash::make('ehrbehu')