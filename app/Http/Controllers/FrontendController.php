<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\OrganizationalStructure;
use App\Models\Blogs;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $division = Divisi::where('slug', 'bph')->first();
        $sliders = Slider::latest()->get();

        $orderedPositions = ['Ketua Umum', 'Sekretaris Umum', 'Bendahara Umum'];

        $members = collect();

        if ($division) {
            $members = OrganizationalStructure::where('divisi_id', $division->id)
                ->whereIn('position', $orderedPositions)->get()->sortBy(function ($member) use ($orderedPositions) {
                    return array_search($member->position, $orderedPositions);
                });
        }

        $blogs = Blogs::latest()->take(3)->get();

        return view('home.index', compact('members', 'blogs', 'sliders'));
    }
}
