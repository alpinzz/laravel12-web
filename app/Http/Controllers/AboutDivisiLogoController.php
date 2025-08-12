<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AboutDivisiLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = DashboardController::title();

        $user = Auth::user();
        // dd($user->divisi_id);

        if ($user->role === 'admin') {
            // Admin lihat semua bidang kecuali BPH
            $divisis = Divisi::where('slug', '!=', 'bph')
                ->with('logoBidang')
                ->get();
        } elseif ($user->role === 'author') {
            // Author hanya lihat bidangnya sendiri
            $divisis = Divisi::where('id', $user->division)
                ->where('slug', '!=', 'bph')
                ->with('logoBidang')
                ->get();
        } else {
            $divisis = collect();
        }

        return view('admin.logo.index', compact('divisis', 'title'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function form(Divisi $divisi)
    {
        $title = DashboardController::title();
        $user = Auth::user();

        if ($user->role === 'author' && $user->division !== $divisi->id) {
            abort(403, 'Uncategorized');
        }

        return view('admin.logo.form', compact('divisi', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Divisi $divisi)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($divisi->logoBidang && Storage::disk('public')->exists($divisi->logoBidang->logo)) {
            Storage::disk('public')->delete($divisi->logoBidang->logo);
        }

        $path = $request->file('logo')->store('logo-bidang', 'public');

        $divisi->logoBidang()->updateOrCreate(
            ['divisi_id' => $divisi->id],
            ['logo' => $path]
        );

        return redirect()->route('admin.logo')->with('message', 'Logo Bidang berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
