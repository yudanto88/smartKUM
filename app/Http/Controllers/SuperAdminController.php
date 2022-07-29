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

        $request->session()->flash('success', 'Data user berhasil ditambahkan');

        return redirect('/dashboard');
    }

    public function editUser(Request $request, $id)
    {
        // $request-> validate([
        //     'name' => 'required|unique:users,name',
        //     'email' => 'required|email:dns',
        //     'password' => 'required|min:6',
        //     'confirmPassword' => 'required|same:password',
        //     'nip' => 'required',
        //     'role_id' => 'required',
        //     'dinas_id' => 'required',
        // ], [
        //     'name.required' => 'Username tidak boleh kosong',
        //     'name.unique' => 'Username sudah terdaftar',
        //     'email.required' => 'Email tidak boleh kosong',
        //     'email.email' => 'Email tidak valid',
        //     'password.required' => 'Password tidak boleh kosong',
        //     'password.min' => 'Password minimal 6 karakter',
        //     'confirmPassword.required' => 'Konfirmasi password tidak boleh kosong',
        //     'confirmPassword.same' => 'Konfirmasi password tidak sama',
        //     'nip.required' => 'NIP tidak boleh kosong',
        //     'role_id.required' => 'Role tidak boleh kosong',
        //     'dinas_id.required' => 'Dinas tidak boleh kosong',
        // ]);

        // DB::table('users')->where('id', $request->id)->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make($request->password),
        //     'nip' => $request->nip,
        //     'dinas_id' => $request->dinas_id,
        //     'role_id' => $request->role_id,
        //     'updated_at' => now()
        // ]);

        // $request->session()->flash('success', 'Data user berhasil diubah');

        // return redirect('/dashboard');
    }

    public function deleteUser(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();

        $request->session()->flash('success', 'Data user berhasil dihapus');

        return redirect('/dashboard');
    }

    public function addRole(Request $request)
    {
        $request-> validate([
            'role' => 'required|unique:roles,role',
        ], [
            'role.required' => 'Role tidak boleh kosong',
            'role.unique' => 'Role sudah terdaftar',
        ]);

        DB::table('roles')->insert([
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data role berhasil ditambahkan');

        return redirect('/dashboard/role');
    }
    
    public function addDinas(Request $request)
    {
        $request-> validate([
            'dinas' => 'required|unique:dinas,dinas',
        ], [
            'dinas.required' => 'Dinas tidak boleh kosong',
            'dinas.unique' => 'Dinas sudah terdaftar',
        ]);

        DB::table('dinas')->insert([
            'dinas' => $request->dinas,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data dinas berhasil ditambahkan');

        return redirect('/dashboard/dinas');
    }
}
