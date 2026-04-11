{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Products')
@section('page-title', '🛍️ Products')

@section('content')

{{-- Filter Bar --}}
<form method="GET" action="{{ route('admin.products.index') }}"
      class="flex flex-col md:flex-row gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}"
           class="flex-1 px-4 py-2.5 rounded-xl text-sm outline-none transition-all"
           style="border: 2px solid #E5E7EB; color:#0F172A;"
           onfocus="this.style.borderColor='#B8860B'"
           onblur="this.style.borderColor='#E5E7EB'"
           placeholder="🔍 Search products..."/>
    <select name="category"
            class="px-4 py-2.5 rounded-xl text-sm outline-none bg-white"
            style="border: 2px solid #E5E7EB; color:#0F172A;"
            onfocus="this.style.borderColor='#B8860B'"
            onblur="this.style.borderColor='#E5E7EB'">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn-gold px-6">Filter</button>
    <a href="{{ route('admin.products.create') }}" class="btn-gold px-6">+ Add Product</a>
</form>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden"
     style="border: 1px solid #F1F5F9;">

    @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background:#F8FAFC; border-bottom: 1px solid #F1F5F9;">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors"
                            style="border-bottom: 1px solid #F8FAFC;">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $product->main_image) }}"
                                         class="w-12 h-12 rounded-xl object-cover shadow-sm"
                                         onerror="this.src='https://via.placeholder.com/48x48/0F172A/D4A017?text=PK'"/>
                                    <div>
                                        <p class="font-semibold text-sm" style="color:#0F172A;">
                                            {{ $product->name }}
                                        </p>
                                        @if($product->allow_custom_image)
                                            <span class="text-xs px-2 py-0.5 rounded-full"
                                                  style="background:rgba(184,134,11,0.1); color:#7B5A00;">
                                                📸 Custom Image
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <span class="text-sm font-bold" style="color:#B8860B;">
                                        ₹{{ number_format($product->current_price, 0) }}
                                    </span>
                                    @if($product->sale_price)
                                        <span class="text-xs text-gray-400 line-through ml-1">
                                            ₹{{ number_format($product->price, 0) }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium" style="color:#0F172A;">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                      style="{{ $product->is_active
                                          ? 'background:#D1FAE5; color:#065F46;'
                                          : 'background:#FEE2E2; color:#991B1B;' }}">
                                    {{ $product->is_active ? '✓ Active' : '✗ Hidden' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="px-3 py-1.5 rounded-lg text-xs font-medium"
                                       style="background:#EFF6FF; color:#2563EB;">✏️ Edit</a>

                                    <form action="{{ route('admin.products.toggle', $product->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg text-xs font-medium"
                                                style="{{ $product->is_active
                                                    ? 'background:#FEF3C7; color:#92400E;'
                                                    : 'background:#D1FAE5; color:#065F46;' }}">
                                            {{ $product->is_active ? 'Hide' : 'Show' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg text-xs font-medium"
                                                style="background:#FEE2E2; color:#991B1B;">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4" style="border-top: 1px solid #F1F5F9;">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-4">🛍️</div>
            <h3 class="text-xl font-bold mb-2" style="color:#0F172A; font-family:'Playfair Display',serif;">
                No Products Found
            </h3>
            <p class="text-gray-400 text-sm mb-6">Start adding products to your shop</p>
            <a href="{{ route('admin.products.create') }}" class="btn-gold">+ Add First Product</a>
        </div>
    @endif
</div>

@endsection