<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\Pelanggan;
use App\Models\PaketInternet;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::with(['paketInternet', 'wilayah', 'monitoring']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kode_pelanggan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $pelanggan = $query->latest()->paginate(15);

        return Inertia::render('pelanggan/index', [
            'pelanggan' => $pelanggan,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paketInternet = PaketInternet::active()->get();
        $wilayah = Wilayah::where('status', 'completed')->get();

        return Inertia::render('pelanggan/create', [
            'paketInternet' => $paketInternet,
            'wilayah' => $wilayah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        $data = $request->validated();
        $data['kode_pelanggan'] = Pelanggan::generateKodePelanggan();

        $pelanggan = Pelanggan::create($data);

        return redirect()->route('pelanggan.show', $pelanggan)
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        $pelanggan->load(['paketInternet', 'wilayah', 'tagihan.pembayaran', 'monitoring']);

        return Inertia::render('pelanggan/show', [
            'pelanggan' => $pelanggan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        $paketInternet = PaketInternet::active()->get();
        $wilayah = Wilayah::where('status', 'completed')->get();

        return Inertia::render('pelanggan/edit', [
            'pelanggan' => $pelanggan,
            'paketInternet' => $paketInternet,
            'wilayah' => $wilayah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->validated());

        return redirect()->route('pelanggan.show', $pelanggan)
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}