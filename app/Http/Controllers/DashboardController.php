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
        if(Auth::user()->role->role == 'superadmin') {
            return view('auth.pages.user', [
                'users' => User::all(),
                'role' => Role::all(),
                'dinas' => Dinas::all()
            ]);
        } else {
            return view('auth.pages.user', [
                'users' => User::all(),
                'role' => Role::all(),
                'dinas' => Dinas::all()
            ]);
        }
    }

    

}
