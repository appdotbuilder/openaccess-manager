<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWilayahRequest;
use App\Http\Requests\UpdateWilayahRequest;
use App\Models\Wilayah;
use App\Models\JenisPerangkat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Wilayah::withCount(['perangkatJaringan', 'pelanggan']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_wilayah', 'like', "%{$search}%")
                  ->orWhere('provinsi', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $wilayah = $query->latest()->paginate(10);

        return Inertia::render('wilayah/index', [
            'wilayah' => $wilayah,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource (Step 1).
     */
    public function create()
    {
        return Inertia::render('wilayah/create', [
            'step' => 1,
        ]);
    }

    /**
     * Store a newly created resource in storage (Step 1).
     */
    public function store(StoreWilayahRequest $request)
    {
        $wilayah = Wilayah::create($request->validated());

        return redirect()->route('wilayah.design', $wilayah)
            ->with('success', 'Data wilayah berhasil disimpan. Lanjut ke tahap desain.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Wilayah $wilayah, Request $request)
    {
        // Handle different steps via query parameters
        $step = $request->get('step', 'view');
        
        switch ($step) {
            case 'design':
                if ($wilayah->status === 'completed') {
                    return redirect()->route('wilayah.show', $wilayah)
                        ->with('info', 'Wilayah sudah selesai dikonfigurasi.');
                }
                
                $jenisPerangkat = JenisPerangkat::active()->get();
                $existingDevices = $wilayah->perangkatJaringan()->with('jenisPerangkat')->get();
                
                return Inertia::render('wilayah/design', [
                    'wilayah' => $wilayah,
                    'jenisPerangkat' => $jenisPerangkat,
                    'existingDevices' => $existingDevices,
                    'step' => 2,
                ]);
                
            case 'rab':
                if ($wilayah->status === 'completed') {
                    return redirect()->route('wilayah.show', $wilayah)
                        ->with('info', 'Wilayah sudah selesai dikonfigurasi.');
                }
                
                $existingRab = $wilayah->rabWilayah;
                
                return Inertia::render('wilayah/rab', [
                    'wilayah' => $wilayah,
                    'existingRab' => $existingRab,
                    'step' => 3,
                ]);
                
            case 'perizinan':
                if ($wilayah->status === 'completed') {
                    return redirect()->route('wilayah.show', $wilayah)
                        ->with('info', 'Wilayah sudah selesai dikonfigurasi.');
                }
                
                $existingPerizinan = $wilayah->perizinanWilayah;
                
                return Inertia::render('wilayah/perizinan', [
                    'wilayah' => $wilayah,
                    'existingPerizinan' => $existingPerizinan,
                    'step' => 4,
                ]);
                
            default:
                $wilayah->load([
                    'perangkatJaringan.jenisPerangkat',
                    'rabWilayah',
                    'perizinanWilayah',
                    'pelanggan'
                ]);
                
                return Inertia::render('wilayah/show', [
                    'wilayah' => $wilayah,
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilayah $wilayah)
    {
        return Inertia::render('wilayah/edit', [
            'wilayah' => $wilayah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWilayahRequest $request, Wilayah $wilayah)
    {
        // Handle completion action
        if ($request->has('action') && $request->action === 'complete') {
            $wilayah->update(['status' => 'completed']);
            
            return redirect()->route('wilayah.show', $wilayah)
                ->with('success', 'Konfigurasi wilayah berhasil diselesaikan!');
        }
        
        $wilayah->update($request->validated());

        return redirect()->route('wilayah.show', $wilayah)
            ->with('success', 'Data wilayah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil dihapus.');
    }
}