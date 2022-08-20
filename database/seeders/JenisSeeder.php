<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis')->insert([
            'jenis' => 'tes',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jenis')->insert([
            'jenis' => 'tes2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('jenis')->insert([
            'jenis' => 'tes3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
