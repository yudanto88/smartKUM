<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Draft;

class LoginController extends Controller
{
    public function index()
    {
        return view('guest.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Email atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function status(){
        return view('guest.status');
    }

    public function searchstatus(Request $request){
        $draft = Draft::where('no_regristrasi', $request->status)->first();

        if(isset($draft)){
            return view('guest.status',[
                'draft' => $draft,
                $request->session()->flash('success', 'No Registrasi ditemukan'),
            ]);

            // return redirect('/status')->with('draft', $draft);
        }else{
            $request->session()->flash('error', 'No Registrasi tidak ditemukan');

            return redirect('/status');
        }
    }
}
