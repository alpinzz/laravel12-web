<?php

namespace App\Http\Controllers;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use App\Models\Divisi;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StructureController extends Controller
{
    public function index($slug)
    {

        $user = auth()->user();

        if ($user->role === 'author' && $user->division !== $slug) {
            abort(403, 'Anda tidak diizinkan mengakses bidang ini.');
        }


        $division = Divisi::where('slug', $slug)->firstOrFail();
        $members = $division->members()->orderBy('order')->get();
        $title = 'Admin ' . $division->name;

        return view('admin.structure.index', compact('division', 'members', 'title'));
    }

    public function create($slug)
    {
        $division = Divisi::where('slug', $slug)->firstOrFail();

        $positions = match ($slug) {
            'bph' => ['Ketua Umum', 'Sekretaris Umum', 'Bendahara Umum'],
            'organisasi' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'kader' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'hikmah' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'rpk' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'olahraga' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'medkom' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'tkk' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
        };

        $title = 'Admin ' . $division->name;

        return view('admin.structure.create', compact('division', 'positions', 'title'));
    }

    public function store(Request $request)
    {

        // dd($request->all());


        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'divisi_id' => 'required|exists:divisis,id'
        ]);

        $division = Divisi::findOrFail($request->divisi_id);

        $isPosition = false;

        if ($division->slug === 'bph') {
            if (in_array($request->position, ['Ketua Umum', 'Sekretaris Umum', 'Bendahara Umum'])) {
                $isPosition = OrganizationalStructure::where('divisi_id', $division->id)->where('position', $request->position)->exists();
            }
        } else {
            if (in_array($request->position, ['Ketua Bidang', 'Sekretaris Bidang'])) {
                $isPosition = OrganizationalStructure::where('divisi_id', $division->id)->where('position', $request->position)->exists();
            }
        }

        if ($isPosition) {
            return redirect()->back()->with('error', 'Posisi ' . $request->position . ' sudah ada');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image = $image->resize(400, 400);
                $resizedImage = $image->toJpeg();
                Storage::disk('public')->put('image/' . $filename, $resizedImage);

                $imagePath = 'image/' . $filename;
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal menambah struktur' . $e->getMessage());
            }
        }
        OrganizationalStructure::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'order' => $request->order ?? 0,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('admin.structure.index', ['slug' => $division->slug])->with('message', 'Berhasil menambah struktur');
    }

    public function edit($slug, $id)
    {
        $division = Divisi::where('slug', $slug)->firstOrFail();
        $member = OrganizationalStructure::findOrFail($id);

        $positions = match ($slug) {
            'bph' => ['Ketua Umum', 'Sekretaris Umum', 'Bendahara Umum'],
            'organisasi' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'kader' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'hikmah' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'rpk' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'olahraga' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'medkom' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
            'tkk' => ['Ketua Bidang', 'Sekretaris Bidang', 'Anggota'],
        };

        $title = 'Admin ' . $division->name;

        return view('admin.structure.edit', compact('division', 'member', 'positions', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'divisi_id' => 'required|exists:divisis,id'
        ]);

        $member = OrganizationalStructure::findOrFail($id);

        $member->name = $request->name;
        $member->position = $request->position;
        $member->order = $request->order ?? 0;

        if ($request->hasFile('image')) {
            if ($member->image && Storage::disk('public')->exists($member->image)) {
                Storage::disk('public')->delete($member->image);
            }

            $file = $request->file('image');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file)->resize(400, 400);
            $resizedImage = $image->toJpeg();

            $filename = uniqid() . '.jpg';
            $imagePath = 'image/' . $filename;

            Storage::disk('public')->put($imagePath, $resizedImage);
            $member->image = $imagePath;
        }

        $member->save();

        $division = Divisi::findOrFail($member->divisi_id);

        return redirect()->route('admin.structure.index', ['slug' => $division->slug])->with('message', 'Struktur Berhasil Diperbarui.');
    }


    public function delete($slug, $id)
    {
        $user = auth()->user();

        if ($user->role === 'author' && $user->division !== $slug) {
            abort(403, 'Anda tidak diizinkan mengakses bidang ini.');
        }

        $member = OrganizationalStructure::findOrFail($id);

        if ($member->image && Storage::disk('public')->exists($member->image)) {
            Storage::disk()->delete($member->image);
        }

        $member->delete();

        return redirect()->route('admin.structure.index', ['slug' => $slug])->with('message', 'Data Berhasil dihapus.');
    }
}
