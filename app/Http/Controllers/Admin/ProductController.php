<?php
// app/Http/Controllers/Admin/ProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|string|max:200',
            'price'         => 'required|numeric|min:0',
            'sale_price'    => 'nullable|numeric|lt:price',
            'main_image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $mainImagePath  = $request->file('main_image')->store('products', 'public');
        $galleryPaths   = [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $img) {
                $galleryPaths[] = $img->store('products/gallery', 'public');
            }
        }

        Product::create([
            'category_id'        => $request->category_id,
            'name'               => $request->name,
            'slug'               => Str::slug($request->name) . '-' . uniqid(),
            'description'        => $request->description,
            'short_description'  => $request->short_description,
            'price'              => $request->price,
            'sale_price'         => $request->sale_price,
            'main_image'         => $mainImagePath,
            'gallery_images'     => $galleryPaths ?: null,
            'allow_custom_image' => $request->boolean('allow_custom_image'),
            'custom_image_label' => $request->custom_image_label,
            'stock'              => $request->stock ?? 100,
            'is_featured'        => $request->boolean('is_featured'),
            'is_active'          => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', '✅ Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:200',
            'price'       => 'required|numeric|min:0',
            'sale_price'  => 'nullable|numeric|lt:price',
            'main_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = [
            'category_id'        => $request->category_id,
            'name'               => $request->name,
            'description'        => $request->description,
            'short_description'  => $request->short_description,
            'price'              => $request->price,
            'sale_price'         => $request->sale_price,
            'allow_custom_image' => $request->boolean('allow_custom_image'),
            'custom_image_label' => $request->custom_image_label,
            'stock'              => $request->stock ?? 100,
            'is_featured'        => $request->boolean('is_featured'),
            'is_active'          => $request->boolean('is_active'),
        ];

        if ($request->hasFile('main_image')) {
            Storage::disk('public')->delete($product->main_image);
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', '✅ Product updated!');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Product status updated.');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->main_image);
        $product->delete();
        return back()->with('success', '🗑️ Product deleted.');
    }
}