<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use App\Models\Divisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BlogsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'author') {
            // Ambil ID divisi dari slug yang disimpan di field 'division' milik user
            $division = \App\Models\Divisi::where('slug', $user->division)->first();

            // Jika divisi ditemukan, filter blog berdasarkan divisi_id
            if ($division) {
                $blogs = Blogs::with('category', 'divisi')
                    ->where('divisi_id', $division->id)
                    ->latest()
                    ->get();
            } else {
                // Jika divisi tidak ditemukan, tampilkan semua blog milik author
                $blogs = Blogs::with('category', 'divisi')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();
            }

            $title = 'Blog Bidang ' . ($division->name ?? $user->division ?? 'Anda');
        } else {
            // Admin lihat semua blog
            $blogs = Blogs::with('category', 'divisi', 'author')
                ->latest()
                ->get();

            $title = 'Semua Blog';
        }

        return view('admin.blogs.index', compact('blogs', 'title'));
    }




    public function create()
    {

        $divisions = Divisi::all();
        $user = auth()->user();

        $categories = Category::all();
        $title = 'Admin ' . $user->division;

        return view('admin.blogs.create', compact('categories', 'divisions', 'title'));
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
        ]);

        $division_id = Auth::user()->role === 'admin' ? $request->divisi_id : Auth::user()->division;

        $slug = Str::slug($request->title);

        $count = Blogs::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $image = $manager->read($file)->resize(400, 400);

            $resizedImage = $image->toJpeg(80);
            Storage::disk('public')->put('image/' . $filename, $resizedImage);

            $imagePath = 'image/' . $filename;
        }

        Blogs::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imagePath,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'divisi_id' => $division_id,
            'user_id' => auth()->check() ? auth()->id() : null
        ]);

        return redirect()->route('admin.blogs.index')->with('message', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        $categories = Category::all();
        $title = 'Edit Page';

        return view('admin.blogs.edit', compact('blog', 'categories', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
            'divisi_id' => 'required|exists:divisis,id',
        ]);

        $blog = Blogs::findOrFail($id);

        $slug = Str::slug($request->title);
        if (Blogs::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug .= '-' . uniqid();
        }

        $imagePath = $blog->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imagePath,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('admin.blogs.index')->with('message', 'Blog berhasil diupdate.');
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);

        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->back()->with('message', 'Blog berhasil dihapus.');
    }
}
