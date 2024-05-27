<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    public function getInfo(Request $request)
    {
        // Ambil data dari request
        $data = $request->all();
        
        // Lakukan logika pengambilan data dari database
        $pesan = Pesan::where('nama', $data['nama'])
                      ->where('checkin', $data['checkin'])
                      ->where('checkout', $data['checkout'])
                      ->where('roomType', $data['roomType'])
                      ->first();
        
        // Kembalikan data dalam format JSON
        return response()->json($pesan);
    }
}
