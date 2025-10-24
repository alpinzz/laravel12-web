<?php

namespace App\Http\Controllers;

use App\Models\AboutDivisionLogo;
use App\Models\AboutUs;
use App\Models\AboutVisionMision;
use App\Models\Blogs;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Divisi;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function allStructure()
    {
        $divisions = Divisi::with('structures')->get()->sortBy(function ($division) {
            return $division->slug === 'bph' ? 0 : 1;
        });

        $divisions->each(function ($division) {
            $ordered = ['Ketua Umum', 'Ketua Bidang', 'Sekretaris Umum', 'Sekretaris Bidang', 'Bendahara Umum', 'Anggota'];

            $division->structures = $division->structures->sortBy(function ($member) use ($ordered) {
                return array_search($member->position, $ordered) ?? 999;
            });
        });


        return view('components.body_home.pages.all_structure', compact('divisions'));
    }

    public function allNews()
    {

        $perPage = 5;
        $blogs = Blogs::with(['divisi', 'category'])->latest()->paginate(5);

        // $category = Category::where('slug', $slug)->firstOrFail();

        $categories = Category::withCount('blogs')->get();

        $currentPage = $blogs->currentPage();
        $lastPage = $blogs->lastPage();

        if ($currentPage === 1) {
            $recentBlogs = Blogs::latest()->take(3)->get();
        } elseif ($currentPage === $lastPage) {
            $recentBlogs = Blogs::oldest()->take(3)->get();
        } else {
            $recentBlogs = Blogs::inRandomOrder()->take(3)->get();
        }

        return view('components.body_home.pages.all_news', compact('blogs', 'categories', 'recentBlogs'));
    }

    public function singleBlog($slug)
    {
        $blog = Blogs::where('slug', $slug)->with(['divisi', 'category'])->firstOrFail();

        $recentBlogs = Blogs::latest()->where('id', '!=', $blog->id)->take(3)->get();
        $categories = Category::withCount('blogs')->get();



        return view('components.body_home.pages.single_blog', compact('blog', 'recentBlogs', 'categories'));
    }

    public function blogByDivisi($slug)
    {
        $divisi = Divisi::where('slug', $slug)->firstOrFail();

        $blogs = $divisi->blogs()->latest()->paginate(6);

        $categories = Category::withCount('blogs')->get();
        $recentBlogs = Blogs::latest()->take(3)->get();
        // $recentBlogs = Blogs::latest()->where('id', '!=', $blogs->id)->take(3)->get();

        return view('components.body_home.pages.blog_by_divisi', compact('blogs', 'categories', 'recentBlogs', 'divisi'));
    }


    public function blogByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $blogs = $category->blogs()->latest()->paginate(6);
        $categories = Category::withCount('blogs')->get();
        $recentBlogs = Blogs::latest()->take(3)->get();

        return view('components.body_home.pages.blog_by_category', compact('category', 'blogs', 'categories', 'recentBlogs'));
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->get();

        return view('components.body_home.pages.gallery', compact('galleries'));
    }

    public function about()
    {
        $about = AboutUs::first();
        $visiMisi = AboutVisionMision::first();
        $logo = AboutDivisionLogo::with('divisi')->get();

        return view('components.body_home.pages.aboutUs', compact('about', 'visiMisi', 'logo'));
    }

    public function contact()
    {
        return view('components.body_home.pages.contact');
    }

    public function searchBlog(Request $request)
    {
    $keyword = trim($request->q);

    if(!$keyword){
        return redirect()->back()->with('message', 'Masukkan kata kunci pencarian');
    }

    $blogs = Blogs::with(['divisi', 'category', 'author'])
        ->where(function($query) use ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(5);

    $categories = Category::withCount('blogs')->get();
    $recentBlogs = Blogs::latest()->take(3)->get();

    return view('components.body_home.pages.all_news', compact('blogs', 'categories', 'recentBlogs'))
            ->with('keyword', $keyword);
    }

}
