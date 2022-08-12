<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KasubagUndang;
use App\Models\StaffUndang;
use App\Models\Kabag;
use App\Models\ProdukHukum;

class KasubagController extends Controller
{
    public function editprodukhukum(Request $request, KasubagUndang $draft){
        return view('auth.kasubag_perundang_undangan.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request){
        switch($request->input('action')){
            case 'tolak':
                $searchDraft = KasubagUndang::find($request->id);

                DB::table('kasubag_undangs')->where('id', $request->id)->update([
                    'status' => 'ditolak',
                    'updated_at' => now()
                ]);
        
                DB::table('staff_undangs')->where('id', $searchDraft->staff_undang_id)->update([
                    'status' => 'ditolak',
                    'keterangan_penolakan' => $request->keterangan,
                    'updated_at' => now()
                ]);
        
                $request->session()->flash('success', 'Data berhasil ditolak');
        
                return redirect('/dashboard');
                break;
            case 'proses':
                $searchDraft = KasubagUndang::find($request->id);

                $searchDraftKabag = Kabag::where('kasubag_undang_id', $searchDraft->id)->first();

                DB::table('kasubag_undangs')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'updated_at' => now()
                ]);

                if(isset($searchDraftKabag)){
                    DB::table('kabags')->where('id', $searchDraftKabag->id)->update([
                        'status' => 'menunggu',
                        'updated_at' => now()
                    ]);
                }else {
                    DB::table('kabags')->insert([
                        'status' => 'menunggu',
                        // 'draft_id' => $searchDraft->draft->draft_id,
                        'kasubag_undang_id' => $request->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }   
                
                $request->session()->flash('success', 'Data berhasil diproses');
        
                return redirect('/dashboard');
                break;
        }
    }

    public function editprodukhukum2(Request $request, ProdukHukum $draft){
        return view('auth.kasubag_dokumentasi.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process2(Request $request){
        switch($request->input('action')){
            case 'tolak':
                $searchDraft = ProdukHukum::find($request->id);

                DB::table('produk_hukums')->where('id', $request->id)->update([
                    'status' => 'ditolak',
                    'updated_at' => now()
                ]);
        
                DB::table('staff_dokumentasis')->where('id', $searchDraft->staff_dokumentasi_id)->update([
                    'status' => 'ditolak',
                    'keterangan_penolakan' => $request->keterangan,
                    'updated_at' => now()
                ]);
        
                $request->session()->flash('success', 'Data berhasil ditolak');
        
                return redirect('/dashboard');
                break;
            case 'proses':
                // $searchDraft = KasubagUndang::find($request->id);

                // $searchDraftKabag = Kabag::where('kasubag_undang_id', $searchDraft->id)->first();

                // DB::table('kasubag_undangs')->where('id', $request->id)->update([
                //     'status' => 'diterima',
                //     'keterangan' => $request->keterangan,
                //     'updated_at' => now()
                // ]);

                // if(isset($searchDraftKabag)){
                //     DB::table('kabags')->where('id', $searchDraftKabag->id)->update([
                //         'status' => 'menunggu',
                //         'updated_at' => now()
                //     ]);
                // }else {
                //     DB::table('kabags')->insert([
                //         'status' => 'menunggu',
                //         // 'draft_id' => $searchDraft->draft->draft_id,
                //         'kasubag_undang_id' => $request->id,
                //         'created_at' => now(),
                //         'updated_at' => now()
                //     ]);
                // }   
                
                $request->session()->flash('success', 'Data berhasil diproses');
        
                return redirect('/dashboard');
                break;
        }
    }
}
