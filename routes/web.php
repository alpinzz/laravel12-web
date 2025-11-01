<?php

use App\Http\Controllers\AboutDivisiLogoController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\VideoProfileController;
use App\Http\Controllers\VisionMisionController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


// Route::get('/storage/{path}', function ($path) {
//     $path = storage_path('app/public/' . $path);

//     if (!File::exists($path)) {
//         abort(404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     return Response::make($file, 200)->header("Content-Type", $type);
// })->where('path', '.*');

Route::get('/file/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!File::exists($fullPath)) {
        abort(404, 'File tidak ditemukan: ' . $fullPath);
    }

    $type = File::mimeType($fullPath);
    return response()->file($fullPath, ['Content-Type' => $type]);
})->where('path', '.*');


Route::get('/', [FrontendController::class, 'index'])->name('index');

// Search Blogs
Route::get('/blogs/search', [PagesController::class, 'searchBlog'])->name('search.blog');

Route::get('/struktur-organisasi', [PagesController::class, 'allStructure'])->name('all.structure');
Route::get('/blogs', [PagesController::class, 'allNews'])->name('all.news');
Route::get('/blogs/divisi/{slug}', [PagesController::class, 'blogByDivisi'])->name('blog.divisi');
Route::get('/blogs/kategori/{slug}', [PagesController::class, 'blogByCategory'])->name('blog.category');
Route::get('/blogs/{slug}', [PagesController::class, 'singleBlog'])->name('single.blog');
Route::get('/gallery', [PagesController::class, 'gallery'])->name('gallery');
Route::get('/tentang-kami', [PagesController::class, 'about'])->name('about');
Route::get('/kontak', [PagesController::class, 'contact'])->name('contact');
Route::post('/kontak-pesan', [ContactController::class, 'store'])->name('contact.message');



Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});

Route::middleware('auth', 'verified', 'role:author')->group(function () {
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
    Route::get('/admin/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/admin/gallery/{id}', [GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/admin/gallery/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.delete');
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


// Route AboutUs
Route::middleware('auth')->group(function () {
    Route::get('/admin/about', [AboutUsController::class, 'index'])->name('admin.about.index');
    Route::get('/admin/about/create', [AboutUsController::class, 'create'])->name('admin.about.create');
    Route::post('/admin/about/store', [AboutUsController::class, 'store'])->name('admin.about.store');
    Route::get('/admin/about/edit', [AboutUsController::class, 'edit'])->name('admin.about.edit');
    Route::post('/admin/about/update', [AboutUsController::class, 'update'])->name('admin.about.update');
    Route::delete('/admin/about/delete', [AboutUsController::class, 'destroy'])->name('admin.about.delete');
});

// Route Visi & Misi
Route::middleware('auth')->group(function () {
    Route::get('/admin/visi-misi', [VisionMisionController::class, 'index'])->name('visi.misi');
    Route::get('/admin/visi-misi/create', [VisionMisionController::class, 'create'])->name('visi.misi.create');
    Route::post('/admin/visi-misi/store', [VisionMisionController::class, 'store'])->name('visi.misi.store');
    Route::get('/admin/visi-misi/edit', [VisionMisionController::class, 'edit'])->name('visi.misi.edit');
    Route::put('/admin/visi-misi/update', [VisionMisionController::class, 'update'])->name('visi.misi.update');
    Route::delete('/admin/visi-misi/delete', [VisionMisionController::class, 'destroy'])->name('visi.misi.delete');
});


// Route Logo Divisi
Route::middleware('auth', 'blockAuthorBPH')->group(function () {
    Route::get('/admin/logo-bidang', [AboutDivisiLogoController::class, 'index'])->name('admin.logo');

    Route::get('/admin/logo-bidang/{divisi}/form', [AboutDivisiLogoController::class, 'form'])->name('admin.logo.form');
    Route::post('/admin/logo-bidang/{divisi}/form', [AboutDivisiLogoController::class, 'store'])->name('admin.logo.store');
    Route::delete('/admin/logo-bidang/{divisi}', [AboutDivisiLogoController::class, 'destroy'])->name('admin.logo.delete');
});

// Route Video
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/video', [VideoProfileController::class, 'index'])->name('admin.video');
    Route::get('/admin/video/create', [VideoProfileController::class, 'create'])->name('admin.video.create');
    Route::post('/admin/video/store', [VideoProfileController::class, 'store'])->name('admin.video.store');
    Route::get('/admin/video/{video}/edit', [VideoProfileController::class, 'edit'])->name('admin.video.edit');
    Route::put('/admin/video/{video}', [VideoProfileController::class, 'update'])->name('admin.video.update');
    Route::delete('/admin/video/{video}', [VideoProfileController::class, 'destroy'])->name('admin.video.delete');
});

// Route Message
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/message', [ContactController::class, 'index'])->name('admin.message');
    Route::get('/admin/message/{message}/detail', [ContactController::class, 'show'])->name('admin.message.show');
    Route::delete('/admin/message/{message}', [ContactController::class, 'destroy'])->name('admin.message.delete');
});


// Matikan route register
// Route::any('/register', function () {
//     abort(403, 'Pendaftaran sudah ditutup.');
// });

