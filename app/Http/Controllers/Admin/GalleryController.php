<?php
// app/Http/Controllers/Admin/GalleryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::orderBy('sort_order')->paginate(20);
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*'   => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
            'category'   => 'required|string',
        ]);

        foreach ($request->file('images') as $img) {
            GalleryImage::create([
                'image_path'  => $img->store('gallery', 'public'),
                'title'       => $request->title,
                'category'    => $request->category,
                'is_featured' => $request->boolean('is_featured'),
                'is_active'   => $request->boolean('is_active', true),
                'sort_order'  => $request->sort_order ?? 0,
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', '✅ Gallery images uploaded!');
    }

    public function destroy(GalleryImage $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', '🗑️ Image deleted.');
    }
}