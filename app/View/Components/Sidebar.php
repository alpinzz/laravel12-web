<?php

namespace App\View\Components;

use App\Models\Divisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $divisis;

    public function __construct()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'admin') {
                $this->divisis = Divisi::where('slug', '!=', 'bph')->get();
            } elseif ($user->role === 'author') {
                $this->divisis = Divisi::where('id', $user->divisi_id)->where('slug', '!=', 'bph')->get();
            } else {
                $this->divisis = collect();
            }
        } else {
            $this->divisis = collect();
        }
    }
    public function render()
    {
        return view('components.sidebar');
    }
}
