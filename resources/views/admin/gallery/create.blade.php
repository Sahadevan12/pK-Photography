{{-- resources/views/admin/gallery/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Upload Gallery Images')
@section('page-title', '➕ Upload Gallery Images')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" style="border: 1px solid #F1F5F9;">

        <div class="p-6" style="border-bottom: 1px solid #F1F5F9;">
            <h2 class="font-bold text-lg" style="color:#0F172A; font-family:'Playfair Display',serif;">
                Upload Gallery Images
            </h2>
        </div>

        <form action="{{ route('admin.gallery.store') }}"
              method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Images <span class="text-red-500">*</span>
                    <span class="text-gray-400 font-normal">(Multiple allowed)</span>
                </label>
                <input type="file" name="images[]" accept="image/*" multiple required
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:font-semibold file:text-white file:cursor-pointer"
                       style="file:background: linear-gradient(135deg, #7B5A00, #D4A017);"/>
                @error('images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Category <span class="text-red-500">*</span>
                </label>
                <select name="category" required
                        class="w-full px-4 py-3 rounded-xl text-sm outline-none bg-white"
                        style="border: 2px solid #E5E7EB; color:#0F172A;"
                        onfocus="this.style.borderColor='#B8860B'"
                        onblur="this.style.borderColor='#E5E7EB'">
                    <option value="wedding">Wedding</option>
                    <option value="pre-wedding">Pre-Wedding</option>
                    <option value="portrait">Portrait</option>
                    <option value="events">Events</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Title <span class="text-gray-400 font-normal">(Optional)</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"
                       placeholder="Photo title..."/>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"/>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center gap-3 p-4 rounded-xl"
                     style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="is_featured" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                        ⭐ Featured
                    </label>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-xl"
                     style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="is_active" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                        ✓ Active
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold flex-1">✅ Upload Images</button>
                <a href="{{ route('admin.gallery.index') }}"
                   class="btn-outline-gold flex-1 text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection