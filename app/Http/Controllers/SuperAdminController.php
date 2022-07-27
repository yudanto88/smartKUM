<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Dinas;

class SuperAdminController extends Controller
{
    public function role()
    {
        return view('auth.pages.role', [
            'user' => Auth::user(),
            'role' => Role::all()
        ]);
    }

    public function dinas()
    {
        return view('auth.pages.dinas', [
            'user' => Auth::user(),
            'dinas' => Dinas::all()
        ]);
    }

    public function profile()
    {
        return view('auth.pages.profile', [
            'user' => Auth::user(),
            'dinas' => Dinas::all()
        ]);
    }

    public function addUser(Request $request)
    {
        $request-> validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'nip' => 'required|unique:users,nip',
            'role_id' => 'required',
            'dinas_id' => 'required',
        ], [
            'name.required' => 'Username tidak boleh kosong',
            'name.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'confirmPassword.required' => 'Konfirmasi password tidak boleh kosong',
            'confirmPassword.same' => 'Konfirmasi password tidak sama',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'role_id.required' => 'Role tidak boleh kosong',
            'dinas_id.required' => 'Dinas tidak boleh kosong',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'nip' => $request->nip,
            'dinas_id' => $request->dinas_id,
            'role_id' => $request->role_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Regristrasi Berhasil, Silahkan Login');

        return redirect('/dashboard');
    }
}
