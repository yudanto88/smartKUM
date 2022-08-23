<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Walikota;
use App\Models\Sekda;
use App\Models\KepalaDinas;
use App\Models\StaffDokumentasi;

class WalikotaController extends Controller
{
    public function editprodukhukum(Request $request, Walikota $draft){
        return view('auth.walikota.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request){
        switch($request->input('action')){
            case 'tolak':
                $searchDraft = Walikota::find($request->id);

                $searchDraftSekda = Sekda::where('id', $searchDraft->sekda_id)->first();

                $searchDraftKepalaDinas = KepalaDinas::where('id', $searchDraftSekda->kepala_dinas_id)->first();

                DB::table('walikotas')->where('id', $request->id)->update([
                    'status' => 'ditolak',
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);

                DB::table('sekdas')->where('id', $searchDraft->sekda_id)->update([
                    'status' => 'ditolak oleh walikota',
                    'updated_at' => now()
                ]);

                DB::table('kepala_dinas')->where('id', $searchDraftSekda->kepala_dinas_id)->update([
                    'status' => 'ditolak oleh walikota',
                    'updated_at' => now()
                ]);

                DB::table('kabags')->where('id', $searchDraftKepalaDinas->kabag_id)->update([
                    'status' => 'ditolak oleh walikota',
                    'keterangan_penolakan' => $request->keterangan,
                    'updated_at' => now()
                ]);
        
                $request->session()->flash('success', 'Data berhasil ditolak');
        
                return redirect('/dashboard');
                break;
            case 'proses':
                $request->validate([
                    'ttd_walikota' => 'mimes:pdf,doc,docx',
                ], [
                    'ttd_walikota.mimes' => 'Tanda Tangan Walikota harus berformat PDF atau Word',
                ]);

                $searchDraft = Walikota::find($request->id);

                if (isset($searchDraft->ttd_walikota) && isset($request->ttd_walikota)) {
                    Storage::delete($searchDraft->ttd_walikota);
                }

                if (isset($request->ttd_walikota)) {
                    $ttdWalikota = $request->file('ttd_walikota')->store('file-ttdWalikota');

                    DB::table('walikotas')->where('id', $request->id)->update([
                        'ttd_walikota' => $ttdWalikota,
                    ]);
                }

                DB::table('walikotas')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);

                DB::table('staff_dokumentasis')->insert([
                    'status' => 'menunggu',
                    // 'draft_id' => $searchDraft->draft->draft_id,
                    'walikota_id' => $request->id,
                    'alur' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                $request->session()->flash('success', 'Data berhasil diproses');
        
                return redirect('/dashboard');
                break;
        }
    }
}
