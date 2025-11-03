<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use PhpParser\Node\Stmt\TryCatch;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $galleries = Gallery::latest()->get();

        if ($user->role === 'author') {
            $divisions = Divisi::findOrFail($user->division);
            $title = DashboardController::title($divisions->name);
        } else {
            $title = DashboardController::title('Gallery');
        }

        return view('admin.gallery.index', compact('galleries', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'author') {
            $division = Divisi::findOrFail($user->division);
            $title = DashboardController::title($division->name);
        } else {
            $title = DashboardController::title('Create Gallery');
        }

        return view('admin.gallery.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'files' => 'required',
    //         'files.*' => 'image|mimes:png,jpg,jpeg|max:2048'
    //     ]);

    //     foreach ($request->file('files') as $file) {
    //         $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    //         $file->storeAs('gallery', $filename, 'public');

    //         Gallery::create(['image' => 'gallery/' . $filename]);
    //     }
    //     return redirect()->route('admin.gallery.index')->with('message', 'Gambar berhasil ditambahkan.');
    // }

    public function store(Request $request)
{
    $request->validate([
        'files' => 'required',
        'files.*' => 'image|mimes:png,jpg,jpeg|max:2048'
    ]);

    foreach ($request->file('files') as $file) {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('gallery');

        // Pastikan folder 'public/gallery' ada
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Simpan file ke public/gallery
        $file->move($destinationPath, $filename);

        // Simpan path ke database (misalnya 'gallery/namafile.jpg')
        Gallery::create(['image' => 'gallery/' . $filename]);
    }

    return redirect()->route('admin.gallery.index')->with('message', 'Gambar berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user();
        $gallery = Gallery::findOrFail($id);

        if ($user->role === 'author') {
            $division = Divisi::findOrFail($user->division);
            $title = DashboardController::title($division->name);
        } else {
            $title = DashboardController::title('Edit Gallery');
        }

        return view('admin.gallery.edit', compact('gallery', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $filename = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('gallery', $filename, 'public');
            $gallery->image = 'gallery/' . $filename;
        }

        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('message', 'Gambar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        if (Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('message', 'Gambar berhasil dihapus.');
    }
}
