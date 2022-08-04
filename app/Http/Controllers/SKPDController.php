<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Draft;
use App\Models\Admin;

class SKPDController extends Controller
{

    public function readprodukhukum(Request $request, Draft $draft){
        return view('auth.skpd.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function addprodukhukum(){
        return view('auth.skpd.addprodukhukum');
    }

    public function storeprodukhukum(Request $request){
        $request-> validate([
            'jenis' => 'required',
            'judul' => 'required',
            'tanggal' => 'required',
            'file_pengajuan' => 'required|mimes:pdf',
            'draft_produk_hukum' => 'required|mimes:pdf',
        ], [
            'jenis.required' => 'Jenis / Bentuk Peraturan tidak boleh kosong',
            'judul.required' => 'Judul Produk Hukum tidak boleh kosong',
            'tanggal.required' => 'Tanggal Pengajuan tidak boleh kosong',
            'file_pengajuan.required' => 'Surat Pengajuan tidak boleh kosong',
            'file_pengajuan.mimes' => 'Surat Pengajuan harus berformat PDF',
            'draft_produk_hukum.required' => 'Draft Produk Hukum tidak boleh kosong',
            'draft_produk_hukum.mimes' => 'Draft Produk Hukum harus berformat PDF',
        ]);

        $filePengajuan = $request->file('file_pengajuan')->store('file-pengajuan');
        $draftProdukHukum = $request->file('draft_produk_hukum')->store('file-draftProdukHukum');

        DB::table('drafts')->insert([
            'jenis' => $request->jenis,
            'judul' => $request->judul,
            'tanggal_pengajuan' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'surat_pengajuan' => $filePengajuan,
            'draft_produk_hukum' => $draftProdukHukum,
            'status' => 'menunggu',
            'user_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('admins')->insert([
            'status' => 'menunggu',
            'draft_id' => DB::getPdo()->lastInsertId(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Berhasil mengajukan produk hukum');

        return redirect('/dashboard');
    }

    public function editprodukhukum(Request $request, Draft $draft){
        return view('auth.skpd.editprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function updateprodukhukum(Request $request, Draft $draft){
        $request-> validate([
            'jenis' => 'required',
            'judul' => 'required',
            'tanggal' => 'required',
            'file_pengajuan' => 'required|mimes:pdf',
            'draft_produk_hukum' => 'required|mimes:pdf',
        ], [
            'jenis.required' => 'Jenis / Bentuk Peraturan tidak boleh kosong',
            'judul.required' => 'Judul Produk Hukum tidak boleh kosong',
            'tanggal.required' => 'Tanggal Pengajuan tidak boleh kosong',
            'file_pengajuan.required' => 'Surat Pengajuan tidak boleh kosong',
            'file_pengajuan.mimes' => 'Surat Pengajuan harus berformat PDF',
            'draft_produk_hukum.required' => 'Draft Produk Hukum tidak boleh kosong',
            'draft_produk_hukum.mimes' => 'Draft Produk Hukum harus berformat PDF',
        ]);

        if($request->file('file_pengajuan') && $request->file('draft_produk_hukum')){
            if(isset($draft->draft->draft_produk_hukum_lama)){
                Storage::delete($request->oldDraftProdukHukum);
                // Storage::delete($request->draft_produk_hukum_lama);
            }
            $filePengajuan = $request->file('file_pengajuan')->store('file-pengajuan');
            $draftProdukHukum = $request->file('draft_produk_hukum')->store('file-draftProdukHukum');
            Storage::delete($request->oldSuratPengajuan );
        }

        DB::table('drafts')->where('id', $request->id)->update([
            'jenis' => $request->jenis,
            'judul' => $request->judul,
            'tanggal_pengajuan' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'surat_pengajuan' => $filePengajuan,
            'draft_produk_hukum' => $draftProdukHukum,
            'draft_produk_hukum_lama' => $request->oldDraftProdukHukum,
            'status' => 'menunggu',
            'user_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('admins')->where('draft_id', $request->id)->update([
            'status' => 'menunggu',
            'draft_id' => $request->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data draft berhasil diubah');

        return redirect('/dashboard');
    }

    public function deleteprodukhukum(Request $request, Draft $draft){
        if($draft->surat_pengajuan){
            Storage::delete($draft->surat_pengajuan);
        }        
        // if($request->surat_pengajuan){
        //     Storage::delete($request->file_pengajuan);
        // }
        // if ($request->surat_pengajuan) {
            // Storage::delete("{{ asset('storage/' . $draft->surat_pengajuan) }}");
        // }
        // !is_null($request->surat_pengajuan) && Storage::delete($request->surat_pengajuan);

        // $draft::find($request->id)->delete();
        // Draft::destroy($request->id);
        $request->session()->flash('success', 'Data draft berhasil dihapus');
        return redirect('/dashboard');
    }
}
