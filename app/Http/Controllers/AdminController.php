<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Draft;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function readprodukhukum(Request $request, Admin $draft){
        return view('auth.admin_fo.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }

    public function tolak(Request $request){
        $searchDraft = Admin::find($request->id);

        DB::table('admins')->where('id', $request->id)->update([
            'status' => 'ditolak',
            'updated_at' => now()
        ]);

        DB::table('drafts')->where('id', $searchDraft->draft_id)->update([
            'status' => 'ditolak',
            'keterangan_penolakan' => $request->keterangan,
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data berhasil ditolak');

        return redirect('/dashboard');
    }
}
