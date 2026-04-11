<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\HeroImage;
use App\Models\Product;
use App\Models\Category;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ✅ NO __construct() with auth middleware here!

    public function index()
    {
        $heroImages = HeroImage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $galleryImages = GalleryImage::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return view('pages.home', compact(
            'heroImages',
            'featuredProducts',
            'categories',
            'galleryImages'
        ));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function preWedding()
    {
        return view('pages.pre-wedding');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:15',
            'message' => 'required|string|max:1000',
        ]);

        return back()->with('success', '✅ Thank you! We will contact you shortly.');
    }
}