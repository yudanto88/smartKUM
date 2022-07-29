<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Dinas;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role->role == '-'){
            return view('auth.newuser.dashboard');
        } else if(Auth::user()->role->role == 'superadmin') {
            return view('auth.pages.user', [
                'users' => User::all(),
                'role' => Role::all(),
                'dinas' => Dinas::all()
            ]);
        } else if(Auth::user()->role->role == 'skpd'){
            return view('auth.skpd.dashboard');
        } else if(Auth::user()->role->role == 'admin_fo'){
            return view('auth.admin_fo.dashboard');
        } else if(Auth::user()->role->role == 'staff_perundang_undangan'){
            return view('auth.staff_perundang_undangan.dashboard');
        } else if(Auth::user()->role->role == 'kasubag_perundang_undangan'){
            return view('auth.kasubag_perundang_undangan.dashboard');
        } else if(Auth::user()->role->role == 'kabag'){
            return view('auth.kabag.dashboard');
        } else if(Auth::user()->role->role == 'kepala_dinas'){
            return view('auth.kepala_dinas.dashboard');
        } else if(Auth::user()->role->role == 'sekda'){
            return view('auth.sekda.dashboard');
        } else if(Auth::user()->role->role == 'walikota'){
            return view('auth.walikota.dashboard');
        } else if(Auth::user()->role->role == 'staff_dokumentasi'){
            return view('auth.staff_dokumentasi.dashboard');
        } else if(Auth::user()->role->role == 'kasubag_dokumentasi'){
            return view('auth.kasubag_dokumentasi.dashboard');
        } else {
            return view('auth.pages.user', [
                'users' => User::all(),
                'role' => Role::all(),
                'dinas' => Dinas::all()
            ]);
        }
    }

    

}
