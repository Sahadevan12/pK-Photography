<?php
// app/Http/Controllers/Admin/CategoryController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100|unique:categories',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'image_path'  => $imagePath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', '✅ Category created!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:100|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data = [
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'is_active'   => $request->boolean('is_active'),
            'sort_order'  => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('image')) {
            if ($category->image_path) Storage::disk('public')->delete($category->image_path);
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', '✅ Category updated!');
    }

    public function destroy(Category $category)
    {
        if ($category->image_path) Storage::disk('public')->delete($category->image_path);
        $category->delete();
        return back()->with('success', '🗑️ Category deleted.');
    }
}