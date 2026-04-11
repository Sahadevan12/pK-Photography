{{-- resources/views/admin/categories/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Add Category')
@section('page-title', '➕ Add Category')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden"
         style="border: 1px solid #F1F5F9;">

        <div class="p-6" style="border-bottom: 1px solid #F1F5F9;">
            <h2 class="font-bold text-lg" style="color:#0F172A; font-family:'Playfair Display',serif;">
                Create New Category
            </h2>
        </div>

        <form action="{{ route('admin.categories.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"
                       placeholder="e.g. Photo Frames"/>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Description
                </label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all resize-none"
                          style="border: 2px solid #E5E7EB; color:#0F172A;"
                          onfocus="this.style.borderColor='#B8860B'"
                          onblur="this.style.borderColor='#E5E7EB'"
                          placeholder="Short description...">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Category Image
                </label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:font-semibold file:text-white file:cursor-pointer"
                       style="file:background: linear-gradient(135deg, #7B5A00, #D4A017);"/>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Sort Order
                </label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"/>
            </div>

            <div class="flex items-center gap-3 p-4 rounded-xl"
                 style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                       style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                <label for="is_active" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                    Active (Visible in shop)
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold flex-1">✅ Create Category</button>
                <a href="{{ route('admin.categories.index') }}"
                   class="btn-outline-gold flex-1 text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection