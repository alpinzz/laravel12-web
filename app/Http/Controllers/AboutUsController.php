<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = DashboardController::title();
        $about = AboutUs::first();

        return view('admin.about.index', compact('about', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = DashboardController::title();

        if (AboutUs::exists()) {
            return redirect()->route('admin.about.index')->with('warning', 'About sudah tersedia.');
        }

        return view('admin.about.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Pakai Intervention untuk resize jika FilePond gagal
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file)->resize(200, 400);
            $resizedImage = $image->toJpeg();

            $filename = uniqid() . '.jpg';
            $imagePath = 'about/' . $filename;

            Storage::disk('public')->put($imagePath, $resizedImage);
        }

        AboutUs::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.about.index')->with('message', 'About berhasil ditambahkan');
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
        $about = AboutUs::first();

        return view('admin.about.edit', compact('title', 'about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $about = AboutUs::first();
        if (!$about) {
            $about = new AboutUs();
        }

        $about->title = $request->title;
        $about->description = $request->description;

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }

            $about->image = $request->file('image')->store('about', 'public');
        }

        $about->save();

        return redirect()->route('admin.about.index')->with('message', 'About berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $about = AboutUs::first();

        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        $about->delete();

        return redirect()->back()->with('message', 'About berhasil dihapus.');
    }
}
