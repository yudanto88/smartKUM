<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Kabag;
use App\Models\KepalaDinas;

class KabagController extends Controller
{
    public function editprodukhukum(Request $request, Kabag $draft){
        return view('auth.kabag.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request){
        switch($request->input('action')){
            case 'tolak':
                $searchDraft = Kabag::find($request->id);

                DB::table('kabags')->where('id', $request->id)->update([
                    'status' => 'ditolak',
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);
        
                DB::table('kasubag_undangs')->where('id', $searchDraft->kasubag_undang_id)->update([
                    'status' => 'ditolak oleh kabag',
                    'keterangan_penolakan' => $request->keterangan,
                    'updated_at' => now()
                ]);
        
                $request->session()->flash('success', 'Data berhasil ditolak');
        
                return redirect('/dashboard');
                break;
            case 'proses':
                $searchDraft = Kabag::find($request->id);

                $searchDraftKepalaDinas = KepalaDinas::where('kabag_id', $searchDraft->id)->first();

                DB::table('kabags')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);

                if(isset($searchDraftKepalaDinas)){
                    DB::table('kepala_dinas')->where('id', $searchDraftKepalaDinas->id)->update([
                        'status' => 'menunggu',
                        'updated_at' => now()
                    ]);
                }else {
                    DB::table('kepala_dinas')->insert([
                        'status' => 'menunggu',
                        // 'draft_id' => $searchDraft->draft->draft_id,
                        'kabag_id' => $request->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                $request->session()->flash('success', 'Data berhasil diproses');
        
                return redirect('/dashboard');
                break;
        }
    }
}