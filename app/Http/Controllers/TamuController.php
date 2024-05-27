<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pesan;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TamuController extends Controller
{

    public function kamar()
    {
        $kamar = Kamar::all();
        $modal = false;
        $data = [];

        if(Pesan::where('userID', Auth::user()->id)->count() > 0){
            $modal = true;
            $data = Pesan::where('userID', Auth::user()->id)->first();
        }
        
        return view('kamar', [
            'kamar' => $kamar,
            'modal' => $modal,
            'data' => $data
        ]);
    }

  public function insert(Request $request)
{
    // Mengambil jumlah kamar yang tersedia berdasarkan nama kamar yang dipilih
    $kamar_tersedia = Kamar::where('nama_kamar', $request->input('pilihan'))->value('jum_kamar');

    // Mengambil jumlah kamar yang diminta oleh pengguna
    $jumlah_kamar_diminta = (int) $request->input('jumlah_kamar');

    // Memastikan jumlah kamar yang diminta tidak melebihi jumlah kamar yang tersedia atau negatif
    if ($jumlah_kamar_diminta <= 0 || $jumlah_kamar_diminta > $kamar_tersedia) {
        return redirect()->back()->with('error', 'Maaf, jumlah kamar yang diminta tidak valid.');
    }

    // Mengurangi jumlah kamar yang tersedia dalam database
    Kamar::where('nama_kamar', $request->input('pilihan'))
         ->decrement('jum_kamar', $jumlah_kamar_diminta);

    // Simpan data pemesanan
    Pesan::create([
        'checkin' => $request->in,
        'checkout' => $request->out,
        'jenis' => $request->input('pilihan'),
        'jumlah_kamar' => $jumlah_kamar_diminta,
        'nama' => $request->input('nama'),
        'email' => $request->input('email'),
        'userID' => Auth::user()->id,
        'no' => $request->no
    ]);

    // Redirect ke halaman kamar setelah penyimpanan berhasil
    return redirect()->route('kamar');
}

    public function index(Request $request)
    {
        $search = $request->search;
        $checkin_start = $request->checkin_start;
        $checkin_end = $request->checkin_end;
    
        $query = Pesan::query();
    
        if ($search) {
            $query->where('nama', 'like', "%{$search}%");
        }
    
        if ($checkin_start && $checkin_end) {
            $query->whereBetween('checkin', [$checkin_start, $checkin_end]);
        }
    
        $data = $query->orderBy('id')->paginate(50);
        return view('pemesanan.index', compact('data'));
    }
    

    public function destroy(Pesan $pemesanan)
    {
        $pemesanan->delete();
        return redirect()->route('pemesanan.index')->with('status', 'destroy');
    }

  
}