<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Wilayah;
use App\Models\PerangkatJaringan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics.
     */
    public function index(Request $request)
    {
        $stats = [
            'total_pelanggan' => Pelanggan::count(),
            'pelanggan_aktif' => Pelanggan::where('status', 'aktif')->count(),
            'pelanggan_expired' => Pelanggan::where('status', 'expired')->count(),
            'total_wilayah' => Wilayah::count(),
            'wilayah_completed' => Wilayah::where('status', 'completed')->count(),
            'total_perangkat' => PerangkatJaringan::count(),
            'tagihan_pending' => Tagihan::where('status', 'pending')->count(),
            'tagihan_overdue' => Tagihan::where('status', 'overdue')->count(),
            'pendapatan_bulan_ini' => Tagihan::where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->sum('total_bayar'),
        ];

        $recentCustomers = Pelanggan::with(['paketInternet', 'wilayah'])
            ->latest()
            ->take(5)
            ->get();

        $recentBills = Tagihan::with('pelanggan')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recentCustomers' => $recentCustomers,
            'recentBills' => $recentBills,
        ]);
    }
}