<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function admin()
    {
        $title = self::title('Dashboard');

        return view('admin.index', compact('title'));
    }

    public function author()
    {
        $title = self::title('Dashboard');
        return view('author.index', compact('title'));
    }

    public static function title($title = '')
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return 'Admin ' . $title;
        }

        if ($user->role === 'author') {
            $divisionName = optional($user->divisi)->name ?? 'Author';
            return ($title && stripos($title, $divisionName) === false)
                ? $divisionName . ' ' . $title
                : $divisionName;
        }

        return $title ?: 'Dashboard';
    }
}
