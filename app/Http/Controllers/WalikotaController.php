<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Walikota;

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
                // $searchDraft = KasubagUndang::find($request->id);

                // DB::table('kasubag_undangs')->where('id', $request->id)->update([
                //     'status' => 'ditolak',
                //     'updated_at' => now()
                // ]);
        
                // DB::table('staff_undangs')->where('id', $searchDraft->staff_undang_id)->update([
                //     'status' => 'ditolak',
                //     'keterangan_penolakan' => $request->keterangan,
                //     'updated_at' => now()
                // ]);
        
                $request->session()->flash('success', 'Data berhasil ditolak');
        
                return redirect('/dashboard');
                break;
            case 'proses':
                // $searchDraft = Sekda::find($request->id);

                DB::table('walikotas')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'updated_at' => now()
                ]);

                DB::table('staff_dokumentasis')->insert([
                    'status' => 'menunggu',
                    // 'draft_id' => $searchDraft->draft->draft_id,
                    'walikota_id' => $request->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                $request->session()->flash('success', 'Data berhasil diproses');
        
                return redirect('/dashboard');
                break;
        }
    }
}
