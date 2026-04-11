{{-- resources/views/admin/products/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit Product')
@section('page-title', '✏️ Edit Product')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden"
         style="border: 1px solid #F1F5F9;">

        <div class="p-6" style="border-bottom: 1px solid #F1F5F9;">
            <h2 class="font-bold text-lg" style="color:#0F172A; font-family:'Playfair Display',serif;">
                Edit: {{ $product->name }}
            </h2>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"/>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Category</label>
                    <select name="category_id" required
                            class="w-full px-4 py-3 rounded-xl text-sm outline-none bg-white"
                            style="border: 2px solid #E5E7EB; color:#0F172A;"
                            onfocus="this.style.borderColor='#B8860B'"
                            onblur="this.style.borderColor='#E5E7EB'">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"/>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Price (₹)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}"
                           step="0.01" min="0" required
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"/>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Sale Price (₹)</label>
                    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}"
                           step="0.01" min="0"
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"/>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Short Description</label>
                <input type="text" name="short_description"
                       value="{{ old('short_description', $product->short_description) }}"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"/>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all resize-none"
                          style="border: 2px solid #E5E7EB; color:#0F172A;"
                          onfocus="this.style.borderColor='#B8860B'"
                          onblur="this.style.borderColor='#E5E7EB'">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Current Image --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Current Image</label>
                <img src="{{ asset('storage/' . $product->main_image) }}"
                     class="w-32 h-32 object-cover rounded-xl shadow-md mb-3"/>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">Replace Image</label>
                <input type="file" name="main_image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:font-semibold file:text-white file:cursor-pointer"
                       style="file:background: linear-gradient(135deg, #7B5A00, #D4A017);"/>
            </div>

            <div class="p-5 rounded-2xl" style="background: rgba(184,134,11,0.04); border: 1px solid rgba(184,134,11,0.15);">
                <div class="flex items-center gap-3 mb-4">
                    <input type="checkbox" name="allow_custom_image" id="allow_custom_image" value="1"
                           {{ $product->allow_custom_image ? 'checked' : '' }}
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="allow_custom_image" class="text-sm font-semibold cursor-pointer" style="color:#0F172A;">
                        📸 Allow Custom Photo Upload
                    </label>
                </div>
                <input type="text" name="custom_image_label"
                       value="{{ old('custom_image_label', $product->custom_image_label) }}"
                       class="w-full px-4 py-2.5 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A; background:white;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"
                       placeholder="Upload Your Photo"/>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center gap-3 p-4 rounded-xl"
                     style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                           {{ $product->is_featured ? 'checked' : '' }}
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="is_featured" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                        ⭐ Featured
                    </label>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-xl"
                     style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ $product->is_active ? 'checked' : '' }}
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="is_active" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                        ✓ Active
                    </label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-gold flex-1">✅ Save Changes</button>
                <a href="{{ route('admin.products.index') }}"
                   class="btn-outline-gold flex-1 text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection