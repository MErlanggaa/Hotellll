<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{// app/Http/Controllers/UserController.php
    public function akun()
    {
        $user = User::find(auth()->id());
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found.');
        }
        return view('user.akun', compact('user'));
    }

    public function updateAkun(Request $request)
    {
        $Admin = Auth::user(); // Menggunakan model User
        $akun = User::find($Admin->id); // Pastikan model User sudah diimpor dengan `use App\Models\User;`
    
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => "required|alpha->id}", // Pastikan tabel dan kolom sesuai dengan skema User
            'password' => 'nullable|min:4|confirmed'
        ]);
    
        if ($request->password) {
            $arr = [
                'nama' => $request->nama_lengkap,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ];
        } else {
            $arr = [
                'nama' => $request->nama_lengkap,
                'username' => $request->username,
            ];
        }
    
        $akun->update($a);
    }
}