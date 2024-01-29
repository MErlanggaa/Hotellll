<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pesan;
use Illuminate\Http\Request;

class TamuController extends Controller
{

    public function kamar()
    {
        $kamar = Kamar::all();
        return view('kamar', ['kamar' => $kamar]);
    }

    public function insert(Request $request)
    {
        Pesan::create([
            'checkin' => $request->in,
            'checkout' => $request->out,
            'jenis' => $request->input('pilihan'),
        ]);
        return redirect()->route('kamar');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $data = Pesan::select('id', 'checkin', 'checkout', 'jenis')->when($search, function ($query, $search) {
            return $query->where('checkin', 'like', "%{$search}%");
        })->orderBy('id')->paginate(50);
        return view('pemesanan.index', ['data' => $data]);
    }

    public function destroy(Pesan $pemesanan)
    {
        $pemesanan->delete();
        return redirect()->route('pemesanan.index')->with('status', 'destroy');
    }
}
