{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Categories')
@section('page-title', '🏷️ Categories')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">{{ $categories->count() }} categories total</p>
    <a href="{{ route('admin.categories.create') }}" class="btn-gold">
        + Add Category
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden"
     style="border: 1px solid #F1F5F9;">

    @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background:#F8FAFC; border-bottom: 1px solid #F1F5F9;">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Slug
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Products
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors"
                            style="border-bottom: 1px solid #F8FAFC;">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($category->image_path)
                                        <img src="{{ asset('storage/' . $category->image_path) }}"
                                             class="w-10 h-10 rounded-xl object-cover"/>
                                    @else
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl"
                                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                                            🏷️
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-sm" style="color:#0F172A;">
                                            {{ $category->name }}
                                        </p>
                                        @if($category->description)
                                            <p class="text-xs text-gray-400 line-clamp-1">
                                                {{ $category->description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <code class="text-xs px-2 py-1 rounded-lg"
                                      style="background:#F1F5F9; color:#475569;">
                                    {{ $category->slug }}
                                </code>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold" style="color:#B8860B;">
                                    {{ $category->products_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                      style="{{ $category->is_active
                                          ? 'background:#D1FAE5; color:#065F46;'
                                          : 'background:#FEE2E2; color:#991B1B;' }}">
                                    {{ $category->is_active ? '✓ Active' : '✗ Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="p-2 rounded-lg text-sm font-medium transition-all"
                                       style="background:#EFF6FF; color:#2563EB;">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete {{ $category->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg text-sm font-medium transition-all"
                                                style="background:#FEE2E2; color:#991B1B;">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-4">🏷️</div>
            <h3 class="text-xl font-bold mb-2" style="color:#0F172A; font-family:'Playfair Display',serif;">
                No Categories Yet
            </h3>
            <p class="text-gray-400 text-sm mb-6">Create categories to organize your products</p>
            <a href="{{ route('admin.categories.create') }}" class="btn-gold">
                + Add First Category
            </a>
        </div>
    @endif
</div>

@endsection