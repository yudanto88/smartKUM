<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
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

    public function editRole(Request $request)
    {
        $validate = [
            'edit_role' => 'required|unique:roles,role',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
             $request->session()->flash('error', 'Data role gagal diubah');
             return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        DB::table('roles')->where('id', $request->id)->update([
            'role' => $request->edit_role,
            'updated_at' => now()
        ]);

        $request->session()->flash('success', 'Data role berhasil diubah');

        return redirect('/dashboard/role');
    }

    public function deleteRole(Request $request)
    {
        DB::table('roles')->where('id', $request->id)->delete();

        $request->session()->flash('success', 'Data role berhasil dihapus');

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
}
