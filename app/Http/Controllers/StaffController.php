<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\StaffUndang;
use App\Models\KasubagUndang;
use App\Models\StaffDokumentasi;
use App\Models\ProdukHukum;

class StaffController extends Controller
{
    public function editprodukhukum(Request $request, StaffUndang $draft){
        return view('auth.staff_perundang_undangan.editprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function updateprodukhukum(Request $request){
        $request->validate([
            'revisi_produk_hukum' => 'required|mimes:pdf',
            'npknd' => 'required|mimes:pdf',
        ], [
            'revisi_produk_hukum.required' => 'Revisi Produk Hukum tidak boleh kosong',
            'revisi_produk_hukum.mimes' => 'Revisi Produk Hukum harus berformat PDF',
            'npknd.required' => 'NPKND tidak boleh kosong',
            'npknd.mimes' => 'NPKND harus berformat PDF',
        ]);

        $searchDraft = StaffUndang::find($request->id);

        $searchDraftKasubag = KasubagUndang::where('staff_undang_id', $searchDraft->id)->first();

        if(isset($searchDraft->revisi_produk_hukum) && isset($searchDraft->npknd)){
            Storage::delete($searchDraft->revisi_produk_hukum);
            Storage::delete($searchDraft->npknd);
        }

        $revisiProdukHukum = $request->file('revisi_produk_hukum')->store('file-revisiProdukHukum');
        $npknd = $request->file('npknd')->store('file-npknd');

        DB::table('staff_undangs')->where('id', $request->id)->update([
            'revisi_produk_hukum' => $revisiProdukHukum,
            'npknd' => $npknd,
            'status' => 'diterima',
            'keterangan' => $request->keterangan,
            'updated_at' => now()
        ]);

        if(isset($searchDraftKasubag)){
            DB::table('kasubag_undangs')->where('id', $searchDraftKasubag->id)->update([
                'status' => 'menunggu',
                'updated_at' => now()
            ]);
        }else {
            DB::table('kasubag_undangs')->insert([
                'status' => 'menunggu',
                'staff_undang_id' => $request->id,
                'created_at' => now(),
                'updated_at' => now()
            ]); 
        }
        
        $request->session()->flash('success', 'Berhasil melanjutkan produk hukum');

        return redirect('/dashboard');
    }

    public function readprodukhukum(Request $request, StaffUndang $draft){
        return view('auth.staff_perundang_undangan.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function editprodukhukum2(Request $request, StaffDokumentasi $draft){
        $searchDraft = StaffDokumentasi::find($request->id);

        if(isset($searchDraft->walikota_id)){
            return view('auth.staff_dokumentasi.editprodukhukum',[
                'draft' => $draft::find($request->id),
            ]);
        }else {
            return view('auth.staff_dokumentasi.metadata',[
                'draft' => $draft::find($request->id),
            ]);
        }
    }

    public function readprodukhukum2(Request $request, StaffDokumentasi $draft){
        return view('auth.staff_dokumentasi.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function next(Request $request, StaffDokumentasi $draft){
        return view('auth.staff_dokumentasi.metadata',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request){
        $request->validate([
            'no_tahun' => 'required',
            'tentang' => 'required',
            'subjek' => 'required',
            'tanggal_pengundangan' => 'required',
            'ttd_walikota' => 'required|mimes:pdf',
        ], [
            'no_tahun.required' => 'No Tahun tidak boleh kosong',
            'tentang.required' => 'Tentang tidak boleh kosong',
            'subjek.required' => 'Subjek tidak boleh kosong',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'ttd_walikota.required' => 'Tanda Tangan Walikota tidak boleh kosong',
            'ttd_walikota.mimes' => 'Tanda Tangan Walikota harus berformat PDF',
        ]);

        $searchDraft = StaffDokumentasi::find($request->id);

        $searchprodukhukum = ProdukHukum::where('staff_dokumentasi_id', $searchDraft->id)->first();

        if(isset($searchDraft->ttd_walikota)){
            Storage::delete($searchDraft->ttd_walikota);
        }

        $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');

        DB::table('staff_dokumentasis')->where('id', $request->id)->update([
            'status' => 'diterima',
            'ttd_walikota' => $ttdWalikota,
            'keterangan' => $request->keterangan,
            'updated_at' => now()
        ]);

        if(isset($searchprodukhukum)){
            DB::table('produk_hukums')->where('id', $searchprodukhukum->id)->update([
                'no_tahun' => $request->no_tahun,
                'tentang' => $request->tentang,
                'subjek' => $request->subjek,
                'status' => 'menunggu',
                'tanggal_pengundangan' => $request->tanggal_pengundangan,
                'updated_at' => now()
            ]);
        }else {
            DB::table('produk_hukums')->insert([
                'no_tahun' => $request->no_tahun,
                'tentang' => $request->tentang,
                'subjek' => $request->subjek,
                'status' => 'menunggu',
                'tanggal_pengundangan' => $request->tanggal_pengundangan,
                'staff_dokumentasi_id' => $request->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $request->session()->flash('success', 'Data berhasil diproses');
        
        return redirect('/dashboard');
    }

    public function addprodukhukum(){
        return view('auth.staff_dokumentasi.addprodukhukum');
    }

    public function storeprodukhukum(Request $request){
        $request->validate([
            'no_tahun' => 'required',
            'tentang' => 'required',
            'subjek' => 'required',
            'tanggal_pengundangan' => 'required',
            'ttd_walikota' => 'required|mimes:pdf',
        ], [
            'no_tahun.required' => 'No Tahun tidak boleh kosong',
            'tentang.required' => 'Tentang tidak boleh kosong',
            'subjek.required' => 'Subjek tidak boleh kosong',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'ttd_walikota.required' => 'Tanda Tangan Walikota tidak boleh kosong',
            'ttd_walikota.mimes' => 'Tanda Tangan Walikota harus berformat PDF',
        ]);
        
        $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');
        
        DB::table('staff_dokumentasis')->insert([
            'no_tahun' => $request->no_tahun,
            'tentang' => $request->tentang,
            'subjek' => $request->subjek,
            'status' => 'menunggu',
            'tanggal_pengundangan' => $request->tanggal_pengundangan,
            'ttd_walikota' => $ttdWalikota,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $request->session()->flash('success', 'Data berhasil ditambahkan');
        
        return redirect('/dashboard/staffd/addprodukhukum');
    }
}
