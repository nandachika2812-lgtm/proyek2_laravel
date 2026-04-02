<?php

namespace App\Http\Controllers;

use App\Models\Balita;

use App\Models\IbuHamil;
use App\Models\Pemeriksaan;
use App\Models\JadwalPosyandu;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard untuk Kader
    public function kader()
    {
        return view("kader.dashboard", [
            "title" => "Dashboard Kader",
            "user" => Auth::user(),

            // Total Balita 
            "totalBalita" => Balita::count(),
            // Chart
            "totalGiziBaik" => Pemeriksaan::where("status_gizi", "Gizi Baik")
                ->count(),

            "totalGiziBuruk" => Pemeriksaan::where("status_gizi", "Gizi Buruk")
                ->count(),

            "totalStunting" => Pemeriksaan::where("status_gizi", "Stunting")
                ->count(),

            // Chart
            "totalIbuHamil" => IbuHamil::count(),
            "totalKondisiBaik" => Pemeriksaan::where("status_ibu", "Kondisi Baik")
                ->count(),

            "totalKondisiAnemia" => Pemeriksaan::where("status_ibu", "Anemia")
                ->count(),

            //jadwal
            "jadwals" => JadwalPosyandu::all(),
        ]);
    }

    public function pengguna()
    {
        // Carikan data jadwal 
        $jadwals = JadwalPosyandu::all();
        return view("pengguna.jadwal", [
            "user" => Auth::user()
        ], compact('jadwals'));
    }
    public function show($slug)
    {
        $jadwal = JadwalPosyandu::where('slug', $slug)->firstOrFail();
        return view("pengguna.show", compact('jadwal'));
    }
}
