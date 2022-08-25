<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\Jenis;
use App\Models\Dinas;

class SuperAdminController extends Controller
{
    public function user()
    {
        return view('auth.pages.user', [
            'users' => User::all(),
            'role' => Role::all(),
            'dinas' => Dinas::all(),
        ]);
    }

    public function dinas()
    {
        return view('auth.pages.dinas', [
            'user' => Auth::user(),
            'dinas' => Dinas::all()
        ]);
    }

    public function jenis()
    {
        return view('auth.pages.jenis', [
            'user' => Auth::user(),
            'jenis' => Jenis::all()
        ]);
    }

    public function addUser(Request $request)
    {
        $request-> validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'nip' => 'required|unique:users,nip',
            'role_id' => 'required',
            'dinas_id' => 'required',
        ], [
            'name.required' => 'Username tidak boleh kosong',
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

    public function editUser(Request $request)
    {
        $validate = [
            'edit_email' => 'required',
            'edit_name' => 'required',
            'edit_nip' => 'required',
            'edit_role_id' => 'required',
            'edit_dinas_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->errors()->has('edit_email')) {

             $request->session()->flash('error', 'Data user gagal diubah');
             return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try { 
            DB::table('users')->where('id', $request->id)->update([
                'email' => $request->edit_email,
                'name' => $request->edit_name,
                'nip' => $request->edit_nip,
                'dinas_id' => $request->edit_dinas_id,
                'role_id' => $request->edit_role_id,
                'updated_at' => now()
            ]);
    
            $request->session()->flash('success', 'Data user berhasil diubah');
    
            return redirect('/dashboard');
          } catch(\Illuminate\Database\QueryException $ex){ 
            $request->session()->flash('error', 'Data user gagal diubah');
            return redirect()->back()->withInput()->withErrors($validator->errors());
          }
    }

    public function deleteUser(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();

        $request->session()->flash('success', 'Data user berhasil dihapus');

        return redirect('/dashboard');
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

    public function editDinas(Request $request){
        $validate = [
            'edit_dinas' => 'required|unique:dinas,dinas',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
             $request->session()->flash('error', 'Data dinas gagal diubah');
             return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        DB::table('dinas')->where('id', $request->id)->update([
            'dinas' => $request->edit_dinas,
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data dinas berhasil diubah');

        return redirect('/dashboard/dinas');
    }

    public function deleteDinas(Request $request)
    {
        DB::table('dinas')->where('id', $request->id)->delete();

        $request->session()->flash('success', 'Data dinas berhasil dihapus');

        return redirect('/dashboard/dinas');
    }

    public function addJenis(Request $request)
    {
        $request-> validate([
            'jenis' => 'required|unique:jenis,jenis',
        ], [
            'jenis.required' => 'Jenis tidak boleh kosong',
            'jenis.unique' => 'Jinas sudah terdaftar',
        ]);

        DB::table('jenis')->insert([
            'jenis' => $request->jenis,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data jenis berhasil ditambahkan');

        return redirect('/dashboard/jenis');
    }

    public function editJenis(Request $request){
        $validate = [
            'edit_jenis' => 'required|unique:jenis,jenis',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
             $request->session()->flash('error', 'Data jenis gagal diubah');
             return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        DB::table('jenis')->where('id', $request->id)->update([
            'jenis' => $request->edit_jenis,
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data jenis berhasil diubah');

        return redirect('/dashboard/jenis');
    }

    public function deleteJenis(Request $request)
    {
        DB::table('jenis')->where('id', $request->id)->delete();

        $request->session()->flash('success', 'Data jenis berhasil dihapus');

        return redirect('/dashboard/jenis');
    }
}
