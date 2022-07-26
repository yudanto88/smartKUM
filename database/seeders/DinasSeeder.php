<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dinas')->insert([
            'dinas' => 'Dinas Komunikasi dan Informatika',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('dinas')->insert([
            'dinas' => 'Dinas Sosial',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
