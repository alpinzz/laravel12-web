<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StructureController;


Route::get('/', [FrontendController::class, 'index'])->name('index');

Route::get('/struktur-organisasi', [PagesController::class, 'allStructure'])->name('all.structure');
Route::get('/blogs', [PagesController::class, 'allNews'])->name('all.news');
Route::get('/blogs/{slug}', [PagesController::class, 'singleBlog'])->name('single.blog');
Route::get('/blogs/divisi/{slug}', [PagesController::class, 'blogByDivisi'])->name('blog.divisi');
Route::get('/blogs/kategori/{slug}', [PagesController::class, 'blogByCategory'])->name('blog.category');


Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
Route::get('/contact', function () {
    return view('components.body_home.pages.contact');
});


// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('author/dashboard', [DashboardController::class, 'author'])->name('author.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::get('/verify', [AdminController::class, 'showVerify'])->name('custom.verification.form');
Route::post('/verify', [AdminController::class, 'verify'])->name('custom.verification.verify');


// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/admin/password/update', [AdminController::class, 'PasswordUpdate'])->name('admin.password.update');
    // Route::post('admin/structure', [OrganizationalStructure::class, 'store'])->name('admin.structure.store');
});


// Route Stucture
Route::middleware('auth')->group(function () {
    Route::get('/admin/structure/{slug}', [StructureController::class, 'index'])->name('admin.structure.index');
    Route::get('/admin/structure/{slug}/create', [StructureController::class, 'create'])->name('admin.structure.create');
    Route::post('/admin/structure', [StructureController::class, 'store'])->name('admin.structure.store');
    Route::get('/admin/structure/{slug}/edit/{id}', [StructureController::class, 'edit'])->name('admin.structure.edit');
    Route::put('/admin/structure/{id}', [StructureController::class, 'update'])->name('admin.structure.update');
    Route::delete('/admin/structure/{slug}/{id}', [StructureController::class, 'delete'])->name('admin.structure.delete');
});


// Route blogs
Route::middleware('auth')->group(function () {
    Route::get('/admin/blogs/index', [BlogsController::class, 'index'])->name('admin.blogs.index');
    Route::get('/admin/blogs/create', [BlogsController::class, 'create'])->name('admin.blogs.create');
    Route::post('/admin/blogs', [BlogsController::class, 'store'])->name('admin.blogs.store');
    Route::get('/admin/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('admin/blogs/{id}', [BlogsController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/admin/blogs/{id}', [BlogsController::class, 'destroy'])->name('admin.blogs.delete');
});

// Route Gallery
Route::middleware('auth')->group(function () {
    Route::get('/admin/gallery/index', [GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/admin/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/admin/gallery', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::post('/admin/gallery/revert', [GalleryController::class, 'revert'])->name('admin.gallery.revert');
});

// Route slider
Route::middleware('auth')->group(function () {
    Route::get('/admin/slider/index', [SliderController::class, 'index'])->name('admin.slider.index');
    Route::get('/admin/slider/create', [SliderController::class, 'create'])->name('admin.slider.create');
    Route::post('/admin/slider/store', [SliderController::class, 'store'])->name('admin.slider.store');
    Route::get('/admin/slider/{id}/edit', [SliderController::class, 'edit'])->name('admin.slider.edit');
    Route::put('/admin/slider/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('/admin/slider/{id}', [SliderController::class, 'destroy'])->name('admin.slider.delete');
});
