<?php

namespace App\Http\Controllers;

use App\Models\VideoProfile;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class VideoProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = DashboardController::title();
        $video = VideoProfile::first();

        return view('admin.videoProfile.index', compact('title', 'video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = DashboardController::title();

        if (VideoProfile::exists()) {
            return redirect()->route('admin.video')->with('warning', 'Video sudah ada.');
        }

        return view('admin.videoProfile.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'yt_url' => 'required|url'
        ]);

        if (VideoProfile::exists()) {
            return redirect()->route('admin.video')->with('warning', 'Video sudah ada, tidak bisa menambah.');
        }

        VideoProfile::create([
            'yt_url' => $request->yt_url
        ]);

        return redirect()->route('admin.video')->with('message', 'Berhasil menambah video profile.');
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
    public function edit(VideoProfile $video)
    {
        $title = DashboardController::title();

        return view('admin.videoProfile.edit', compact('title', 'video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoProfile $video)
    {
        $request->validate([
            'yt_url' => 'required|url'
        ]);

        $video->update([
            'yt_url' => $request->yt_url
        ]);

        return redirect()->route('admin.video')->with('message', 'Videp berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoProfile $video)
    {
        try {
            $video->delete();

            return redirect()->route('admin.video')->with('message', 'Video berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.video')->with('error', 'Gagal menghapus video.');
        }
    }
}
