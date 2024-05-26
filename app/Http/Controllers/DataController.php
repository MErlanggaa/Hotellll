<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class DataController extends Controller
{
    public function fetchData()
    {
        // Query untuk mengambil jumlah checkout berdasarkan bulan
        $data = Pesanan::selectRaw('MONTH(chech_out) as bulan, COUNT(*) as jumlah_checkout')
                        ->whereRaw('MONTH(chech_out) != MONTH(chech_in)')
                        ->groupBy('bulan')
                        ->get();

        // Mengembalikan data dalam format JSON
        return response()->json($data);
    }
}