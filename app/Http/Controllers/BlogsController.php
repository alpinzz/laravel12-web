<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BlogsController extends Controller
{
    public function index()
    {

        $blogs = Blogs::with('category', 'divisi')->latest()->get();


        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {

        $divisions = Divisi::all();

        $categories = Category::all();

        return view('admin.blogs.create', compact('categories', 'divisions'));
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
            'divisi_id' => 'required|exists:divisis,id'
        ]);

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
            'divisi_id' => $request->divisi_id
        ]);

        return redirect()->route('admin.blogs.index')->with('message', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        $categories = Category::all();

        return view('admin.blogs.edit', compact('blog', 'categories'));
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
