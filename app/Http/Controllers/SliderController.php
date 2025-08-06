<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sliders = Slider::latest()->get();

        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|image'
        ]);

        $imagePath = $request->file('image')->store('slider', 'public');

        Slider::create([
            'image' => $imagePath
        ]);

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

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($slider->image);
            $slider->image = $request->file('image')->store('slider', 'public');
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
            Storage::delete($slider->image);
        }


        $slider->delete();

        return redirect()->back()->with('success', 'Berhasil hapus gambar slider.');
    }
}
