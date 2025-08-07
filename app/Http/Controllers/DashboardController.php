<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.index', [
            'title' => 'Dashboard Admin'
        ]);
    }

    public function author()
    {
        return view('author.index', [
            'title' => 'Dashboard' . ucfirst($user->division_id ?? 'Author')
        ]);
    }
}
