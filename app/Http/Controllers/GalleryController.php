<?php
// app/Http/Controllers/GalleryController.php
namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');

        $query = GalleryImage::where('is_active', true)->orderBy('sort_order');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $images     = $query->get();
        $categories = GalleryImage::where('is_active', true)
            ->distinct()
            ->pluck('category');

        return view('pages.gallery', compact('images', 'categories', 'category'));
    }
}