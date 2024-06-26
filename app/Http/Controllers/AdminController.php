<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Admin::select('id', 'nama', 'username', 'role')->when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('id')->paginate(50);
        return view('admin.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|alpha_dash|unique:admins',
            'password' => 'required|min:4|confirmed'
        ]);

        Admin::create([
            'nama' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'resepsionis',
        ]);

        return redirect()->route('admin.index')->with('status', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', ['row' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => "required|alpha_dash|unique:admins,username,{$admin->id}",
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

        $admin->update($arr);

        return redirect()->route('admin.index')->with('status', 'update');
    }
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('status', 'destroy');
    }

   /* public function akun()
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            return view('admin.akun', ['row' => $admin]);
        } else if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            return view('akun', ['row' => $user]);
        }*/
    public function akun()
    {
        $admin = Auth::user();
        return view('admin.akun', ['row' => $admin]);
    }
    

    public function updateAkun(Request $request)
    {
        $admin = Auth::user();
        $akun = Admin::find($admin->id);

        $request->validate([
            'nama_lengkap' => 'required',
            'username' => "required|alpha_dash|unique:admins,username,{$admin->id}",
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

        $akun->update($arr);

        return back()->with('status', 'update');
    }

    public function dashboard(){

        // $pesan = Pesan::all();
        $checkout = [];
        $checkin = [];
        $bulan = [];
        // foreach($pesan as $p){
            // dd($p);
            for($i = 1; $i <= 12; $i++){
                $out = Pesan::whereMonth('checkout',$i)->count();
                $in = Pesan::whereMonth('checkin',$i)->count();
                $bulan[] = date("F", mktime(0, 0, 0, $i, 10)); 
                $checkout[] = $out;
                $checkin[] = $in;
            }
        // }

        return view('dashboard', [
            'bulan' => json_encode($bulan),
            'checkout' => json_encode($checkout), 
            'checkin' => json_encode($checkin), 
        ]);
    }
}