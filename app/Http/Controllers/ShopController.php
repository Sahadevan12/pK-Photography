<?php
// app/Http/Controllers/ShopController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'price_asc') {
            $query->orderByRaw('COALESCE(sale_price, price) ASC');
        } elseif ($request->sort === 'price_desc') {
            $query->orderByRaw('COALESCE(sale_price, price) DESC');
        } else {
            $query->latest();
        }

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'related'));
    }
}