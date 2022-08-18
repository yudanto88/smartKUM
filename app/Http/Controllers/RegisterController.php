<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Dinas;

class RegisterController
{
    public function index()
    {
        return view('guest.register', [
            'dinas' => Dinas::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'name' => 'required|unique:users,name',
            'nip' => 'unique:users,nip',
            'dinas_id' => 'required',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'confirmPassword.required' => 'Konfirmasi password tidak boleh kosong',
            'confirmPassword.same' => 'Konfirmasi password tidak sama',
            'name.required' => 'Username tidak boleh kosong',
            'name.unique' => 'Username sudah terdaftar',
            'nip.unique' => 'NIP sudah terdaftar',
            'dinas_id.required' => 'Dinas tidak boleh kosong',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'nip' => $request->nip,
            'dinas_id' => $request->dinas_id,
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Regristrasi Berhasil, Silahkan Login');

        return redirect('/login');
    }
}
