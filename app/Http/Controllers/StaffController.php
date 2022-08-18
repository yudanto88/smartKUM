<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            'revisi_produk_hukum' => 'required|mimes:pdf,doc,docx',
            'npknd' => 'required|mimes:pdf,doc,docx',
        ], [
            'revisi_produk_hukum.required' => 'Revisi Produk Hukum tidak boleh kosong',
            'revisi_produk_hukum.mimes' => 'Revisi Produk Hukum harus berformat PDF atau Word',
            'npknd.required' => 'NPKND tidak boleh kosong',
            'npknd.mimes' => 'NPKND harus berformat PDF atau Word',
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
            'validated' => Auth::user()->name,
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

    public function katalogprodukhukum(Request $request){
        return view('auth.staff_dokumentasi.katalogprodukhukum',[
            'staff_dokumentasi' => StaffDokumentasi::all(),
        ]);
    }

    public function editprodukhukum2(Request $request, StaffDokumentasi $draft){
        return view('auth.staff_dokumentasi.editprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function editprodukhukumlama(Request $request, StaffDokumentasi $draft){
        return view('auth.staff_dokumentasi.metadata',[
            'draft' => $draft::find($request->id),
        ]);
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
            'ttd_walikota' => 'required|mimes:pdf,doc,docx',
            'ttd_walikota_salinan' => 'required|mimes:pdf,doc,docx',
        ], [
            'no_tahun.required' => 'No Tahun tidak boleh kosong',
            'tentang.required' => 'Tentang tidak boleh kosong',
            'subjek.required' => 'Subjek tidak boleh kosong',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'ttd_walikota.required' => 'Tanda Tangan Walikota tidak boleh kosong',
            'ttd_walikota.mimes' => 'Tanda Tangan Walikota harus berformat PDF atau Word',
            'ttd_walikota_salinan.required' => 'Tanda Tangan Walikota Salinan tidak boleh kosong',
            'ttd_walikota_salinan.mimes' => 'Tanda Tangan Walikota Salinan harus berformat PDF atau Word',
        ]);

        $searchDraft = StaffDokumentasi::find($request->id);

        $searchprodukhukum = ProdukHukum::where('staff_dokumentasi_id', $searchDraft->id)->first();

        if(isset($searchDraft->ttd_walikota)){
            Storage::delete($searchDraft->ttd_walikota);
        }

        if(isset($searchprodukhukum->ttd_walikota_salinan)){
            Storage::delete($searchprodukhukum->ttd_walikota_salinan);
        }

        $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');
        $ttdWalikotaSalinan = $request->file('ttd_walikota_salinan')->store('file-ttdWalikotaSalinan');

        DB::table('staff_dokumentasis')->where('id', $request->id)->update([
            'status' => 'diterima',
            'ttd_walikota' => $ttdWalikota,
            'keterangan' => $request->keterangan,
            'validated' => Auth::user()->name,
            'updated_at' => now()
        ]);

        if(isset($searchprodukhukum)){
            DB::table('produk_hukums')->where('id', $searchprodukhukum->id)->update([
                'no_tahun' => $request->no_tahun,
                'tentang' => $request->tentang,
                'subjek' => $request->subjek,
                'status' => 'menunggu',
                'ttd_walikota_salinan' => $ttdWalikotaSalinan,
                'tanggal_pengundangan' => $request->tanggal_pengundangan,
                'updated_at' => now()
            ]);
        }else {
            DB::table('produk_hukums')->insert([
                'no_tahun' => $request->no_tahun,
                'tentang' => $request->tentang,
                'subjek' => $request->subjek,
                'status' => 'menunggu',
                'ttd_walikota_salinan' => $ttdWalikotaSalinan,
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
            'ttd_walikota' => 'required|mimes:pdf,doc,docx',
            'ttd_walikota_salinan' => 'required|mimes:pdf,doc,docx',
        ], [
            'no_tahun.required' => 'No Tahun tidak boleh kosong',
            'tentang.required' => 'Tentang tidak boleh kosong',
            'subjek.required' => 'Subjek tidak boleh kosong',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'ttd_walikota.required' => 'Tanda Tangan Walikota tidak boleh kosong',
            'ttd_walikota.mimes' => 'Tanda Tangan Walikota harus berformat PDF atau Word',
            'ttd_walikota_salinan.required' => 'Tanda Tangan Walikota Salinan tidak boleh kosong',
            'ttd_walikota_salinan.mimes' => 'Tanda Tangan Walikota Salinan harus berformat PDF atau Word',
        ]);
        
        $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');
        $ttdWalikotaSalinan = $request->file('ttd_walikota_salinan')->store('file-ttdWalikotaSalinan');
        
        DB::table('staff_dokumentasis')->insert([
            'status' => 'diterima',
            'ttd_walikota' => $ttdWalikota,
            'keterangan' => $request->keterangan,
            'validated' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('produk_hukums')->insert([
            'no_tahun' => $request->no_tahun,
            'tentang' => $request->tentang,
            'subjek' => $request->subjek,
            'status' => 'menunggu',
            'ttd_walikota_salinan' => $ttdWalikotaSalinan,
            'tanggal_pengundangan' => $request->tanggal_pengundangan,
            'staff_dokumentasi_id' => DB::getPdo()->lastInsertId(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $request->session()->flash('success', 'Data berhasil ditambahkan');
        
        return redirect('/dashboard/produkhukumlama');
    }
}
