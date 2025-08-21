<?php

namespace App\Http\Controllers;

use App\Models\AboutVisionMision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisionMisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = DashboardController::title();
        $data = AboutVisionMision::first();

        return view('admin.visi.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = DashboardController::title();
        $data = AboutVisionMision::first();

        if ($data) {
            return redirect()
                ->route('visi.misi')
                ->with('warning', 'Data visi dan misi sudah ada, tidak bisa menambah lagi.');
        }

        return view('admin.visi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array',
            'missions.*' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'vision' => $request->vision,
            'missions' => array_values($request->missions),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vision_mision', 'public');
        }

        AboutVisionMision::create($data);


        return redirect()->route('visi.misi')->with('message', 'Visi & Misi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $title = DashboardController::title();
        $data = AboutVisionMision::first();

        return view('admin.visi.edit', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $request->validate([
            'vision' => 'required|string',
            'missions' => 'required|array',
            'missions.*' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'vision' => $request->vision,
            'missions' => array_values($request->missions),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vision_mision', 'public');
        }

        AboutVisionMision::first()->update($data);

        return redirect()->route('visi.misi')->with('message', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $title = DashboardController::title();
        $data = AboutVisionMision::first();

        if ($data->image && Storage::disk('public')->exists($data->image)) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return redirect()->route('visi.misi')->with('message', 'Visi & Misi berhasil dihapus.');
    }
}
