{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Add Product')
@section('page-title', '➕ Add Product')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden"
         style="border: 1px solid #F1F5F9;">

        <div class="p-6" style="border-bottom: 1px solid #F1F5F9;">
            <h2 class="font-bold text-lg" style="color:#0F172A; font-family:'Playfair Display',serif;">
                Create New Product
            </h2>
        </div>

        <form action="{{ route('admin.products.store') }}"
              method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Name --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"
                           placeholder="e.g. Classic Gold Photo Frame"/>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" required
                            class="w-full px-4 py-3 rounded-xl text-sm outline-none bg-white transition-all"
                            style="border: 2px solid #E5E7EB; color:#0F172A;"
                            onfocus="this.style.borderColor='#B8860B'"
                            onblur="this.style.borderColor='#E5E7EB'">
                        <option value="">Select category...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Stock --}}
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                        Stock Quantity
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', 100) }}" min="0"
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"/>
                </div>

                {{-- Price --}}
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                        Regular Price (₹) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" value="{{ old('price') }}"
                           step="0.01" min="0" required
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"
                           placeholder="599.00"/>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Sale Price --}}
                <div>
                    <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                        Sale Price (₹) <span class="text-gray-400 font-normal">(Optional)</span>
                    </label>
                    <input type="number" name="sale_price" value="{{ old('sale_price') }}"
                           step="0.01" min="0"
                           class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"
                           placeholder="449.00"/>
                </div>
            </div>

            {{-- Short Description --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Short Description
                </label>
                <input type="text" name="short_description" value="{{ old('short_description') }}"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"
                       placeholder="One line product summary"/>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Full Description
                </label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all resize-none"
                          style="border: 2px solid #E5E7EB; color:#0F172A;"
                          onfocus="this.style.borderColor='#B8860B'"
                          onblur="this.style.borderColor='#E5E7EB'"
                          placeholder="Detailed product description...">{{ old('description') }}</textarea>
            </div>

            {{-- Main Image --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Main Product Image <span class="text-red-500">*</span>
                </label>
                <input type="file" name="main_image" accept="image/*" required
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:font-semibold file:text-white file:cursor-pointer"
                       style="file:background: linear-gradient(135deg, #7B5A00, #D4A017);"
                       onchange="previewMain(this)"/>
                @error('main_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <img id="mainPreview" class="mt-3 w-32 h-32 object-cover rounded-xl shadow hidden"/>
            </div>

            {{-- Gallery Images --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Gallery Images <span class="text-gray-400 font-normal">(Optional, multiple)</span>
                </label>
                <input type="file" name="gallery[]" accept="image/*" multiple
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-full file:border-0 file:font-semibold file:text-white file:cursor-pointer"
                       style="file:background: linear-gradient(135deg, #0F172A, #1E293B);"/>
            </div>

            {{-- Custom Image Options --}}
            <div class="p-5 rounded-2xl" style="background: rgba(184,134,11,0.04); border: 1px solid rgba(184,134,11,0.15);">
                <div class="flex items-center gap-3 mb-4">
                    <input type="checkbox" name="allow_custom_image" id="allow_custom_image" value="1"
                           {{ old('allow_custom_image') ? 'checked' : '' }}
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="allow_custom_image" class="text-sm font-semibold cursor-pointer" style="color:#0F172A;">
                        📸 Allow Customer to Upload Custom Photo
                    </label>
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-2">Upload Button Label</label>
                    <input type="text" name="custom_image_label" value="{{ old('custom_image_label', 'Upload Your Photo') }}"
                           class="w-full px-4 py-2.5 rounded-xl text-sm outline-none transition-all"
                           style="border: 2px solid #E5E7EB; color:#0F172A; background:white;"
                           onfocus="this.style.borderColor='#B8860B'"
                           onblur="this.style.borderColor='#E5E7EB'"
                           placeholder="Upload Your Photo"/>
                </div>
            </div>

            {{-- Toggles --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center gap-3 p-4 rounded-xl"
                     style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                           {{ old('is_featured') ? 'checked' : '' }}
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="is_featured" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                        ⭐ Featured Product
                    </label>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-xl"
                     style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                    <label for="is_active" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                        ✓ Active (Visible in shop)
                    </label>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold flex-1">✅ Create Product</button>
                <a href="{{ route('admin.products.index') }}"
                   class="btn-outline-gold flex-1 text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewMain(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('mainPreview');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush