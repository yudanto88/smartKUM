<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\StaffUndang;

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

        if(isset($request->revisi_produk_hukum) && isset($request->npknd)){
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

        $request->session()->flash('success', 'Berhasil melanjutkan produk hukum');

        return redirect('/dashboard');
    }

    public function readprodukhukum(Request $request, StaffUndang $draft){
        return view('auth.staff_perundang_undangan.readprodukhukum',[
            'draft' => $draft::find($request->id),
        ]);
    }
}
