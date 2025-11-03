<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sliders = Slider::latest()->get();
        $title = DashboardController::title();


        return view('admin.slider.index', compact('sliders', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = DashboardController::title();

        return view('admin.slider.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'image' => 'required',
            'image.*' => 'mimes:png,jpg,jpeg,webp|image'
        ]);

        $manager = new ImageManager(new Driver());

    foreach ($request->file('image') as $file) {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            if ($image->width() !== 1920 || $image->height() !== 1080) {
                $image->cover(1920, 1080);
            }

            // Pastikan folder ada
            $directory = storage_path('app/public/slider');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $filename = uniqid() . '.webp';
            $path = 'slider/' . $filename;

            // Simpan file ke folder
            $image->toWebp(90)->save(storage_path('app/public/' . $path));

            // Simpan ke database
            Slider::create(['image' => $path]);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan gambar: ' . $e->getMessage()]);
        }
    }


        return redirect()->route('admin.slider.index')->with('message', 'Slider berhasil ditambahkan');
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
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $title = DashboardController::title();


        return view('admin.slider.edit', compact('slider', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|image'
        ]);

        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $file = $request->file('image');

            try {
                // Baca gambar
                $image = $manager->read($file);

                // Jika ukuran tidak sesuai, resize di server
                if ($image->width() !== 1920 || $image->height() !== 1080) {
                    $image->cover(1920, 1080);
                }

                // Hapus gambar lama
                if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                    Storage::disk('public')->delete($slider->image);
                }

                // Simpan gambar baru
                $filename = uniqid() . '.webp';
                $path = 'slider/' . $filename;
                $image->toWebp(90)->save(storage_path('app/public/' . $path));

                // Update path di database
                $slider->image = $path;
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Gagal memproses gambar: ' . $e->getMessage()]);
            }
        }

        $slider->save();

        return redirect()->route('admin.slider.index')->with('message', 'Berhasil update slider.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && Storage::exists($slider->image)); {
            Storage::disk('public')->delete($slider->image);
        }


        $slider->delete();

        return redirect()->back()->with('message', 'Berhasil hapus gambar slider.');
    }
}
