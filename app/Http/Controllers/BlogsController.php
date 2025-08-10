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
            $division = Divisi::where('slug', $user->division)->first();

            if ($division) {
                $blogs = Blogs::with('category', 'divisi')
                    ->where('divisi_id', $division->id)
                    ->latest()
                    ->get();
            } else {
                $blogs = Blogs::with('category', 'divisi')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();
            }

            $title = DashboardController::title($division->name ?? 'Blogs');
        } else {
            // Admin lihat semua blog
            $blogs = Blogs::with('category', 'divisi', 'author')
                ->latest()
                ->get();
            $title = DashboardController::title('Blogs');
        }

        return view('admin.blogs.index', compact('blogs', 'title'));
    }

    public function create()
    {
        $user = auth()->user();
        $divisions = Divisi::all();

        if ($user->role === 'author') {
            $division = Divisi::findOrFail($user->division);
            $title = DashboardController::title($division->name);
        } else {
            $division = null;
            $title = DashboardController::title('Create Blog');
        }

        $categories = Category::all();

        return view('admin.blogs.create', compact('categories', 'divisions', 'title', 'division'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
        ]);

        $user = Auth::user();
        $division_id = $user->role === 'admin'
            ? $request->divisi_id
            : $user->division;

        $slug = Str::slug($request->title);
        if (Blogs::where('slug', $slug)->exists()) {
            $slug .= '-' . uniqid();
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
            'user_id' => $user->id
        ]);

        return redirect()->route('admin.blogs.index')->with('message', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        $categories = Category::all();
        $division = Divisi::find($blog->divisi_id);

        $title = DashboardController::title($division->name ?? 'Edit Blog');

        return view('admin.blogs.edit', compact('blog', 'categories', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
            'divisi_id' => 'nullable|exists:divisis,id',
        ]);

        $blog = Blogs::findOrFail($id);

        $slug = Str::slug($request->title);
        if (Blogs::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug .= '-' . uniqid();
        }

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('blog_images', $filename, 'public');
            $blog->image = 'blog_images/' . $filename;
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $blog->image,
            'category_id' => $request->category_id,
            'divisi_id' => $request->divisi_id ?? $blog->divisi_id
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
