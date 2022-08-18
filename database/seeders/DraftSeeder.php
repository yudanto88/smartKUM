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
        // DB::table('drafts')->insert([
        //     'jenis' => 'test',
        //     'judul' => 'test2',
        //     'tanggal_pengajuan' => now(),
        //     'keterangan' => 'test3',
        //     // 'surat_pengajuan' => 'file-pengajuan\ymiOjIDqfMRJyHKf8KblzFrCz0dXXt2iQWyCNMGn.pdf',
        //     // 'draft_produk_hukum' => 'file-draftProdukHukum\mXo9mqf0m0MPKamVWtmbYgCkDAw8obtcG3MlTSov.pdf',
        //     // 'draft_produk_hukum_lama' => 'file-draftProdukHukum\mXo9mqf0m0MPKamVWtmbYgCkDAw8obtcG3MlTSov.pdf',
        //     'status' => 'menunggu',
        //     'user_id' => 2,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('drafts')->insert([
        //     'jenis' => '2test',
        //     'judul' => '2test2',
        //     'tanggal_pengajuan' => now(),
        //     'keterangan' => '2test3',
        //     // 'surat_pengajuan' => 'file-pengajuan\ymiOjIDqfMRJyHKf8KblzFrCz0dXXt2iQWyCNMGn.pdf',
        //     // 'draft_produk_hukum' => 'file-draftProdukHukum\mXo9mqf0m0MPKamVWtmbYgCkDAw8obtcG3MlTSov.pdf',
        //     'status' => 'menunggu',
        //     'user_id' => 2,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('drafts')->insert([
        //     'jenis' => '3test',
        //     'judul' => '3test2',
        //     'tanggal_pengajuan' => now(),
        //     'keterangan' => '3test3',
        //     // 'surat_pengajuan' => 'file-pengajuan\ymiOjIDqfMRJyHKf8KblzFrCz0dXXt2iQWyCNMGn.pdf',
        //     // 'draft_produk_hukum' => 'file-draftProdukHukum\mXo9mqf0m0MPKamVWtmbYgCkDAw8obtcG3MlTSov.pdf',
        //     'status' => 'ditolak',
        //     'user_id' => 2,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

    }
}
