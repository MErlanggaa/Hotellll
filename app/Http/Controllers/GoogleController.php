<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try{
            $admin = Socialite::driver('google')->user();

            $findAdmin = Admin::where('username', $admin->username)->first();

            if($findAdmin){
                Auth::login($findAdmin);
                return redirect('/kamar');
            } else {
                // Tambahkan data pengguna baru ke dalam tabel 'admin'
                $newAdmin = Admin::updateOrCreate(
                    ['username' => $admin->email], // Kunci pencarian
                    [
                        'username' => $admin->email,
                        'password' => bcrypt(rand(10000, 100000000)),
                        'google_id' => $admin->id, // Menyertakan nilai untuk kolom google_id
                        'role' => 'user', // Atur peran default sesuai kebutuhan aplikasi Anda
                        'nama' => $admin->name, // Tambahkan nilai untuk kolom nama
                    ]);
                

                Auth::login($newAdmin);
                return redirect('/kamar');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}