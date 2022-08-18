<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admins')->insert([
        //     'status' => 'diterima',
        //     'keterangan' => 'test6',
        //     'keterangan_penolakan' => 'test6',
        //     'draft_id' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('admins')->insert([
        //     'status' => 'menunggu',
        //     'keterangan' => 'test7',
        //     'keterangan_penolakan' => 'test7',
        //     'draft_id' => 2,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        
        // DB::table('admins')->insert([
        //     'status' => 'ditolak',
        //     'keterangan' => 'test7',
        //     'keterangan_penolakan' => 'test7',
        //     'draft_id' => 3,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }
}
