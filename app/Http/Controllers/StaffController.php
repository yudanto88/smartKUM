<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Draft;
use App\Models\Jenis;
use App\Models\StaffUndang;
use App\Models\KasubagUndang;
use App\Models\StaffDokumentasi;
use App\Models\Walikota;
use App\Models\Sekda;
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
        return view('auth.staff_dokumentasi.editmetadata',[
            'draft' => $draft::find($request->id),
            'draftAll' => ProdukHukum::all(),
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
            'draftAll' => ProdukHukum::all(),
        ]);
    }

    public function process(Request $request){
        $request->validate([
            'nomor' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'tanggal_pengundangan' => 'required', 
            'persetujuan' => 'mimes:pdf,doc,docx',
            'ttd_walikota' => 'mimes:pdf,doc,docx',
            'ttd_walikota_salinan' => 'required|mimes:pdf,doc,docx',
        ], [
            'nomor.required' => 'Nomor tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'judul.required' => 'Judul tidak boleh kosong',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'persetujuan.mimes' => 'Persetujuan Sekda harus berformat PDF atau Word',
            'ttd_walikota.mimes' => 'TTD Walikota harus berformat PDF atau Word',
            'ttd_walikota_salinan.required' => 'TTD Walikota Salinan tidak boleh kosong',
            'ttd_walikota_salinan.mimes' => 'TTD Walikota Salinan harus berformat PDF atau Word',
        ]);

        $searchDraft = StaffDokumentasi::find($request->id);

        $searchprodukhukum = ProdukHukum::where('staff_dokumentasi_id', $searchDraft->id)->first();

        $searchWalikota = Walikota::where('id', $searchDraft->walikota_id)->first();

        $searchSekda = Sekda::where('id', $searchWalikota->sekda_id)->first();

        if(isset($searchprodukhukum->ttd_walikota_salinan)){
            Storage::delete($searchprodukhukum->ttd_walikota_salinan);
        }

        $ttdWalikotaSalinan = $request->file('ttd_walikota_salinan')->store('file-ttdWalikotaSalinan');

        if(!isset($searchWalikota->ttd_walikota) && isset($request->ttd_walikota)){
            $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');
            DB::table('walikotas')->where('id', $searchWalikota->id)->update([
                'ttd_walikota' => $ttdWalikota,
            ]);
        }

        if(!isset($searchSekda->persetujuan) && isset($request->persetujuan)){
            $persetujuan = $request->file('persetujuan')->store('file-persetujuan');
            DB::table('sekdas')->where('id', $searchSekda->id)->update([
                'persetujuan' => $persetujuan,
            ]);
        }
        
        DB::table('staff_dokumentasis')->where('id', $request->id)->update([
            'status' => 'diterima',
            'keterangan' => $request->keterangan,
            'validated' => Auth::user()->name,
            'updated_at' => now()
        ]);

        if(isset($searchprodukhukum)){
            $statusDokumen = '';
            $mengganti = null;

            if($request->status_dokumen == 'berlaku'){
                $statusDokumen = $request->status_dokumen;
            }

            if($request->status_dokumen == 'mengganti'){
                $statusDokumen = $request->status_dokumen;
                $mengganti = $request->mengganti;
            }

            DB::table('produk_hukums')->where('id', $searchprodukhukum->id)->update([
                'nomor' => $request->nomor,
                'tahun' => $request->tahun,
                'judul' => $request->judul,
                'pemrakarsa' => $request->pemrakarsa,
                'status_dokumen' => $statusDokumen,
                'mengganti' => $mengganti,
                'status' => 'menunggu',
                'jenis' => $request->jenis,
                'subjek' => $request->subjek,
                'sumber' => $request->sumber,
                'no_regristrasi' => $request->no_regristrasi,
                'bidang_hukum' => $request->bidang_hukum,
                'tanggal_pengundangan' => $request->tanggal_pengundangan,
                'ttd_walikota_salinan' => $ttdWalikotaSalinan,
                'staff_dokumentasi_id' => $request->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('produk_hukums')->where('judul', $mengganti)->update([
                'status_dokumen' => 'dicabut',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $request->session()->flash('success', 'Data berhasil diproses');
        
            return redirect('/dashboard/katalogprodukhukum');

        }else {
            $statusDokumen = '';
            $mengganti = null;

            if($request->status_dokumen == 'berlaku'){
                $statusDokumen = $request->status_dokumen;
            }

            if($request->status_dokumen == 'mengganti'){
                $statusDokumen = $request->status_dokumen;
                $mengganti = $request->mengganti;
            }

            DB::table('produk_hukums')->insert([
                'nomor' => $request->nomor,
                'tahun' => $request->tahun,
                'judul' => $request->judul,
                'pemrakarsa' => $request->pemrakarsa,
                'status_dokumen' => $statusDokumen,
                'mengganti' => $mengganti,
                'status' => $request->status,
                'jenis' => $request->jenis,
                'subjek' => $request->subjek,
                'sumber' => $request->sumber,
                'no_regristrasi' => $request->no_regristrasi,
                'bidang_hukum' => $request->bidang_hukum,
                'tanggal_pengundangan' => $request->tanggal_pengundangan,
                'ttd_walikota_salinan' => $ttdWalikotaSalinan,
                'staff_dokumentasi_id' => $request->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('produk_hukums')->where('judul', $mengganti)->update([
                'status_dokumen' => 'dicabut',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $request->session()->flash('success', 'Data berhasil diproses');
        
            return redirect('/dashboard');

        }
    }

    public function editmetadata(Request $request){
        $request->validate([
            'nomor' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'tanggal_pengundangan' => 'required', 
            'persetujuan' => 'mimes:pdf,doc,docx',
            'ttd_walikota' => 'mimes:pdf,doc,docx',
            'ttd_walikota_salinan' => 'required|mimes:pdf,doc,docx',
        ], [
            'nomor.required' => 'Nomor tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'judul.required' => 'Judul tidak boleh kosong',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'persetujuan.mimes' => 'Persetujuan Sekda harus berformat PDF atau Word',
            'ttd_walikota.mimes' => 'TTD Walikota harus berformat PDF atau Word',
            'ttd_walikota_salinan.required' => 'TTD Walikota Salinan tidak boleh kosong',
            'ttd_walikota_salinan.mimes' => 'TTD Walikota Salinan harus berformat PDF atau Word',
        ]);

        $searchDraft = StaffDokumentasi::find($request->id);

        $searchprodukhukum = ProdukHukum::where('staff_dokumentasi_id', $searchDraft->id)->first();

        $searchWalikota = Walikota::where('id', $searchDraft->walikota_id)->first();

        if(isset($searchprodukhukum->ttd_walikota_salinan)){
            Storage::delete($searchprodukhukum->ttd_walikota_salinan);
        }

        $ttdWalikotaSalinan = $request->file('ttd_walikota_salinan')->store('file-ttdWalikotaSalinan');

        if(isset($request->persetujuan) || isset($request->ttd_walikota)){
            if(isset($request->persetujuan)){
                $persetujuan = $request->file('persetujuan')->store('file-persetujuan');

                DB::table('sekdas')->where('id', $searchWalikota->sekda_id)->update([
                    'status' => 'diterima',
                    'persetujuan' => $persetujuan,
                    'updated_at' => now()
                ]);
        
                DB::table('walikotas')->where('id', $searchDraft->walikota_id)->update([
                    'status' => 'diterima',
                    'alur' => 1,
                    'updated_at' => now()
                ]);
        
                DB::table('staff_dokumentasis')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);
            }
            
            if(isset($request->ttd_walikota)){
                $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');

                DB::table('sekdas')->where('id', $searchWalikota->sekda_id)->update([
                    'status' => 'diterima',
                    'updated_at' => now()
                ]);
        
                DB::table('walikotas')->where('id', $searchDraft->walikota_id)->update([
                    'status' => 'diterima',
                    'ttd_walikota' => $ttdWalikota,
                ]);
        
                DB::table('staff_dokumentasis')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);
            }

            if(isset($request->persetujuan) && isset($request->ttd_walikota)){
                $persetujuan = $request->file('persetujuan')->store('file-persetujuan');
                $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');

                DB::table('sekdas')->where('id', $searchWalikota->sekda_id)->update([
                    'status' => 'diterima',
                    'persetujuan' => $persetujuan,
                    'updated_at' => now()
                ]);
        
                DB::table('walikotas')->where('id', $searchDraft->walikota_id)->update([
                    'status' => 'diterima',
                    'ttd_walikota' => $ttdWalikota,
                    'updated_at' => now()
                ]);
        
                DB::table('staff_dokumentasis')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);
            }
        }

        if(!isset($request->persetujuan) && !isset($request->ttd_walikota)){
            DB::table('staff_dokumentasis')->where('id', $request->id)->update([
                'status' => 'diterima',
                'keterangan' => $request->keterangan,
                'validated' => Auth::user()->name,
                'updated_at' => now()
            ]);
        }

        $statusDokumen = '';
        $mengganti = null;

        if($request->status_dokumen == 'berlaku'){
            $statusDokumen = $request->status_dokumen;
        }

        if($request->status_dokumen == 'mengganti'){
            $statusDokumen = $request->status_dokumen;
            $mengganti = $request->mengganti;
        }

        DB::table('produk_hukums')->where('id', $searchprodukhukum->id)->update([
            'nomor' => $request->nomor,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'pemrakarsa' => $request->pemrakarsa,
            'status_dokumen' => $statusDokumen,
            'mengganti' => $mengganti,
            'status' => 'menunggu',
            'jenis' => $request->jenis,
            'subjek' => $request->subjek,
            'sumber' => $request->sumber,
            'no_regristrasi' => $request->no_regristrasi,
            'bidang_hukum' => $request->bidang_hukum,
            'tanggal_pengundangan' => $request->tanggal_pengundangan,
            'ttd_walikota_salinan' => $ttdWalikotaSalinan,
            'staff_dokumentasi_id' => $request->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('produk_hukums')->where('judul', $mengganti)->update([
            'status_dokumen' => 'dicabut',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data berhasil diproses');
    
        return redirect('/dashboard/katalogprodukhukum');
    }

    public function addprodukhukum(){
        return view('auth.staff_dokumentasi.addprodukhukum', [
            'draftAll' => ProdukHukum::all(),
            'jenis' => Jenis::all()
        ]);
    }

    public function storeprodukhukum(Request $request){
        $request->validate([
            'nomor' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'pemrakarsa' => 'required',
            'jenis' => 'required',
            'no_regristrasi' => 'required|unique:produk_hukums,no_regristrasi',
            'tanggal_pengundangan' => 'required',
            'persetujuan' => 'mimes:pdf,doc,docx',
            'ttd_walikota' => 'mimes:pdf,doc,docx',
            'ttd_walikota_salinan' => 'required|mimes:pdf,doc,docx',
        ], [
            'nomor.required' => 'Nomor tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'judul.required' => 'Judul tidak boleh kosong',
            'pemrakarsa.required' => 'SKPD Pemrakarsa tidak boleh kosong',
            'no_regristrasi.required' => 'No Register tidak boleh kosong',
            'no_regristrasi.unique' => 'No Registrasi sudah terdaftar',
            'tanggal_pengundangan.required' => 'Tanggal Pengundangan tidak boleh kosong',
            'persetujuan.mimes' => 'Persetujuan Sekda harus berformat PDF atau Word',
            'ttd_walikota.mimes' => 'TTD Walikota harus berformat PDF atau Word',
            'ttd_walikota_salinan.required' => 'TTD Walikota Salinan tidak boleh kosong',
            'ttd_walikota_salinan.mimes' => 'TTD Walikota Salinan harus berformat PDF atau Word',
        ]);

        $ttdWalikotaSalinan = $request->file('ttd_walikota_salinan')->store('file-ttdWalikotaSalinan');
        
        if(isset($request->persetujuan) || isset($request->ttd_walikota)){
            if(isset($request->persetujuan)){
                $persetujuan = $request->file('persetujuan')->store('file-persetujuan');

                DB::table('sekdas')->insert([
                    'status' => 'diterima',
                    'persetujuan' => $persetujuan,
                ]);
        
                DB::table('walikotas')->insert([
                    'status' => 'diterima',
                    'alur' => 1,
                    'sekda_id' => DB::getPdo()->lastInsertId(),
                ]);
        
                DB::table('staff_dokumentasis')->insert([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'walikota_id' => DB::getPdo()->lastInsertId(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            if(isset($request->ttd_walikota)){
                $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');

                DB::table('sekdas')->insert([
                    'status' => 'diterima',
                ]);
        
                DB::table('walikotas')->insert([
                    'status' => 'diterima',
                    'ttd_walikota' => $ttdWalikota,
                    'alur' => 1,
                    'sekda_id' => DB::getPdo()->lastInsertId(),
                ]);
        
                DB::table('staff_dokumentasis')->insert([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'walikota_id' => DB::getPdo()->lastInsertId(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            if(isset($request->persetujuan) && isset($request->ttd_walikota)){
                $persetujuan = $request->file('persetujuan')->store('file-persetujuan');
                $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');

                DB::table('sekdas')->insert([
                    'status' => 'diterima',
                    'persetujuan' => $persetujuan,
                ]);
        
                DB::table('walikotas')->insert([
                    'status' => 'diterima',
                    'ttd_walikota' => $ttdWalikota,
                    'alur' => 1,
                    'sekda_id' => DB::getPdo()->lastInsertId(),
                ]);
        
                DB::table('staff_dokumentasis')->insert([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'walikota_id' => DB::getPdo()->lastInsertId(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        if(!isset($request->persetujuan) && !isset($request->ttd_walikota)){
            DB::table('staff_dokumentasis')->insert([
                'status' => 'diterima',
                'keterangan' => $request->keterangan,
                'validated' => Auth::user()->name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $statusDokumen = '';
        $mengganti = null;

        if($request->status_dokumen == 'berlaku'){
            $statusDokumen = $request->status_dokumen;
        }

        if($request->status_dokumen == 'mengganti'){
            $statusDokumen = $request->status_dokumen;
            $mengganti = $request->mengganti;
        }

        DB::table('produk_hukums')->insert([
            'nomor' => $request->nomor,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'pemrakarsa' => $request->pemrakarsa,
            'status_dokumen' => $statusDokumen,
            'mengganti' => $mengganti,
            'status' => 'menunggu',
            'jenis' => $request->jenis,
            'subjek' => $request->subjek,
            'sumber' => $request->sumber,
            'no_regristrasi' => $request->no_regristrasi,
            'bidang_hukum' => $request->bidang_hukum,
            'tanggal_pengundangan' => $request->tanggal_pengundangan,
            'ttd_walikota_salinan' => $ttdWalikotaSalinan,
            'staff_dokumentasi_id' => DB::getPdo()->lastInsertId(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('produk_hukums')->where('judul', $mengganti)->update([
            'status_dokumen' => 'dicabut',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        $request->session()->flash('success', 'Data berhasil ditambahkan');
        
        return redirect('/dashboard/katalogprodukhukum');
    }
}
