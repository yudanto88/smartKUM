<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\KepalaDinas;
use App\Models\Sekda;

class KepalaDinasController extends Controller
{
    public function editprodukhukum(Request $request, KepalaDinas $draft){
        return view('auth.kepala_dinas.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request){
        $searchDraft = KepalaDinas::find($request->id);

        $searchDraftSekda = Sekda::where('kepala_dinas_id', $searchDraft->id)->first();

        DB::table('kepala_dinas')->where('id', $request->id)->update([
            'status' => 'diterima',
            'keterangan' => $request->keterangan,
            'validated' => Auth::user()->name,
            'updated_at' => now()
        ]);

        if(isset($searchDraftSekda)){
            DB::table('sekdas')->where('id', $searchDraftSekda->id)->update([
                'status' => 'menunggu',
                'updated_at' => now()
            ]);
        }else {
            DB::table('sekdas')->insert([
                'status' => 'menunggu',
                // 'draft_id' => $searchDraft->draft->draft_id,
                'kepala_dinas_id' => $request->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
                
        $request->session()->flash('success', 'Data berhasil diproses');
        
        return redirect('/dashboard');
    }
}

