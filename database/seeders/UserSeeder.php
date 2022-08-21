<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dwi',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin'),
            'nip' => '1',
            'dinas_id' => 2,
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Muhammad',
            'email' => 'skpd@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '2',
            'dinas_id' => 3,
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Nur',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '3',
            'dinas_id' => 2,
            'role_id' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Dewi',
            'email' => 'staff_u@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '4',
            'dinas_id' => 3,
            'role_id' =>5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Tri',
            'email' => 'kasubag_u@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '5',
            'dinas_id' => 2,
            'role_id' =>6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Ahamad',
            'email' => 'kabag@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '6',
            'dinas_id' => 3,
            'role_id' =>7,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Kurniawan',
            'email' => 'kepala_dinas@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '7',
            'dinas_id' => 2,
            'role_id' =>8,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Putri',
            'email' => 'sekda@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '8',
            'dinas_id' => 3,
            'role_id' =>9,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Ilham',
            'email' => 'walikota@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '9',
            'dinas_id' => 1,
            'role_id' =>10,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Nurul',
            'email' => 'staff_d@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '10',
            'dinas_id' => 3,
            'role_id' =>11,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Eko',
            'email' => 'kasubag_d@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'nip' => '11',
            'dinas_id' => 2,
            'role_id' =>12,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
