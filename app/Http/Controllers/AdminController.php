<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Draft;
use App\Models\StaffUndang;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function readprodukhukum(Request $request, Admin $draft){
        return view('auth.admin_fo.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request){
        switch($request->input('action')){
            case 'tolak':
                $searchDraft = Admin::find($request->id);

                DB::table('admins')->where('id', $request->id)->update([
                    'status' => 'ditolak',
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);
        
                DB::table('drafts')->where('id', $searchDraft->draft_id)->update([
                    'status' => 'ditolak',
                    'keterangan_penolakan' => $request->keterangan,
                    'updated_at' => now()
                ]);
        
                $request->session()->flash('success', 'Data berhasil ditolak');
        
                return redirect('/dashboard');
                break;
            case 'proses':
                $request-> validate([
                    'no_regristrasi' => 'required|unique:drafts,no_regristrasi',
                ], [
                    'no_regristrasi.required' => 'No Registrasi tidak boleh kosong',
                    'no_regristrasi.unique' => 'No Registrasi sudah terdaftar',
                ]);

                $searchDraft = Admin::find($request->id);

                DB::table('drafts')->where('id', $searchDraft->draft_id)->update([
                    'no_regristrasi' => $request->no_regristrasi,
                    'updated_at' => now()
                ]);

                DB::table('admins')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);

                DB::table('staff_undangs')-> insert([
                    'status' => 'menunggu',
                    // 'draft_id' => $searchDraft->draft->draft_id,
                    'admin_id' => $request->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                $request->session()->flash('success', 'Data berhasil diproses');
        
                return redirect('/dashboard');
                break;
        }
    }
}
