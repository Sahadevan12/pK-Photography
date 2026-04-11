<?php
// app/Http/Controllers/Admin/HeroImageController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroImageController extends Controller
{
    public function index()
    {
        $heroImages = HeroImage::orderBy('sort_order')->get();
        return view('admin.hero-images.index', compact('heroImages'));
    }

    public function create()
    {
        return view('admin.hero-images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'      => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title'      => 'nullable|string|max:200',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('hero-images', 'public');

        HeroImage::create([
            'image_path' => $path,
            'title'      => $request->title,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.hero-images.index')
            ->with('success', '✅ Hero image uploaded successfully!');
    }

    public function edit(HeroImage $heroImage)
    {
        return view('admin.hero-images.edit', compact('heroImage'));
    }

    public function update(Request $request, HeroImage $heroImage)
    {
        $request->validate([
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title'      => 'nullable|string|max:200',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'title'      => $request->title,
            'is_active'  => $request->boolean('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($heroImage->image_path);
            $data['image_path'] = $request->file('image')->store('hero-images', 'public');
        }

        $heroImage->update($data);

        return redirect()->route('admin.hero-images.index')
            ->with('success', '✅ Hero image updated!');
    }

    public function toggle(HeroImage $heroImage)
    {
        $heroImage->update(['is_active' => !$heroImage->is_active]);
        return back()->with('success', 'Status updated.');
    }

    public function destroy(HeroImage $heroImage)
    {
        Storage::disk('public')->delete($heroImage->image_path);
        $heroImage->delete();
        return back()->with('success', '🗑️ Hero image deleted.');
    }
}