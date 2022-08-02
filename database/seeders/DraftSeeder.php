<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drafts')->insert([
            'jenis' => 'test',
            'judul' => 'test',
            'tanggal_pengajuan' => now(),
            'keterangan' => 'test',
            'surat_pengajuan' => 'test',
            'draft_produk_hukum' => 'test',
            'keterangan_penolakan' => 'test',
            'status' => 'Diterima',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('drafts')->insert([
            'jenis' => 'test1',
            'judul' => 'test1',
            'tanggal_pengajuan' => now(),
            'keterangan' => 'test1',
            'surat_pengajuan' => 'test1',
            'draft_produk_hukum' => 'test1',
            'keterangan_penolakan' => 'test1',
            'status' => 'menunggu',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
