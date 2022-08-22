<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekda;
use App\Models\KepalaDinas;
use App\Models\Walikota;

class SekdaController extends Controller
{
    public function editprodukhukum(Request $request, Sekda $draft)
    {
        return view('auth.sekda.readprodukhukum', [
            'draft' => $draft::find($request->id),
        ]);
    }

    public function process(Request $request)
    {
        switch ($request->input('action')) {
            case 'tolak':
                $searchDraft = Sekda::find($request->id);

                $searchDraftKepalaDinas = KepalaDinas::where('id', $searchDraft->kepala_dinas_id)->first();

                DB::table('sekdas')->where('id', $request->id)->update([
                    'status' => 'ditolak',
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);

                DB::table('kepala_dinas')->where('id', $searchDraft->kepala_dinas_id)->update([
                    'status' => 'ditolak oleh sekda',
                    'updated_at' => now()
                ]);

                DB::table('kabags')->where('id', $searchDraftKepalaDinas->kabag_id)->update([
                    'status' => 'ditolak oleh sekda',
                    'keterangan_penolakan' => $request->keterangan,
                    'updated_at' => now()
                ]);

                $request->session()->flash('success', 'Data berhasil ditolak');

                return redirect('/dashboard');
                break;
            case 'proses':
                $request->validate([
                    'persetujuan' => 'mimes:pdf,doc,docx',
                ], [
                    'persetujuan.mimes' => 'File persetujuan harus berformat PDF atau Word',
                ]);

                $searchDraft = Sekda::find($request->id);

                $searchDraftWalikota = Walikota::where('sekda_id', $searchDraft->id)->first();

                if (isset($searchDraft->persetujuan) && isset($request->persetujuan)) {
                    Storage::delete($searchDraft->persetujuan);
                }

                if (isset($request->persetujuan)) {
                    $persetujuan = $request->file('persetujuan')->store('file-persetujuan');

                    DB::table('sekdas')->where('id', $request->id)->update([
                        'persetujuan' => $persetujuan,
                    ]);
                }

                DB::table('sekdas')->where('id', $request->id)->update([
                    'status' => 'diterima',
                    'keterangan' => $request->keterangan,
                    'validated' => Auth::user()->name,
                    'updated_at' => now()
                ]);

                if (isset($searchDraftWalikota)) {
                    DB::table('walikotas')->where('id', $searchDraftWalikota->id)->update([
                        'status' => 'menunggu',
                        'updated_at' => now()
                    ]);
                } else {
                    DB::table('walikotas')->insert([
                        'status' => 'menunggu',
                        // 'draft_id' => $searchDraft->draft->draft_id,
                        'sekda_id' => $request->id,
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
