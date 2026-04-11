{{-- resources/views/admin/hero-images/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Add Hero Image')
@section('page-title', '➕ Add Hero Image')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden"
         style="border: 1px solid #F1F5F9;">

        <div class="p-6" style="border-bottom: 1px solid #F1F5F9;">
            <h2 class="font-bold text-lg" style="color:#0F172A; font-family:'Playfair Display',serif;">
                Upload New Hero Image
            </h2>
            <p class="text-sm text-gray-400 mt-1">
                This image will appear in the homepage gallery strip
            </p>
        </div>

        <form action="{{ route('admin.hero-images.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6 space-y-6">
            @csrf

            {{-- Image Upload --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    📸 Image <span class="text-red-500">*</span>
                </label>

                {{-- Drop Zone --}}
                <div id="dropZone"
                     class="relative border-2 border-dashed rounded-2xl p-8 text-center cursor-pointer transition-all duration-200"
                     style="border-color: rgba(184,134,11,0.4); background: rgba(184,134,11,0.02);"
                     onclick="document.getElementById('imageInput').click()"
                     ondragover="event.preventDefault(); this.style.borderColor='#D4A017'; this.style.background='rgba(212,160,23,0.05)'"
                     ondragleave="this.style.borderColor='rgba(184,134,11,0.4)'; this.style.background='rgba(184,134,11,0.02)'"
                     ondrop="handleDrop(event)">

                    <div id="uploadPlaceholder">
                        <div class="text-5xl mb-3">📷</div>
                        <p class="font-semibold text-sm mb-1" style="color:#0F172A;">
                            Click or drag image here
                        </p>
                        <p class="text-xs text-gray-400">
                            JPG, PNG, WEBP — Max 5MB
                        </p>
                    </div>

                    <div id="previewContainer" class="hidden">
                        <img id="imagePreview"
                             class="max-h-64 mx-auto rounded-xl object-cover shadow-md"/>
                        <p class="text-xs text-gray-400 mt-2" id="fileName"></p>
                    </div>

                    <input type="file"
                           id="imageInput"
                           name="image"
                           accept="image/*"
                           class="hidden"
                           onchange="previewImage(this)"
                           required/>
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Title --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Title <span class="text-gray-400 font-normal">(Optional)</span>
                </label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'; this.style.boxShadow='0 0 0 3px rgba(184,134,11,0.1)'"
                       onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'"
                       placeholder="e.g. Wedding Ceremony Shot"/>
            </div>

            {{-- Sort Order --}}
            <div>
                <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                    Sort Order
                </label>
                <input type="number"
                       name="sort_order"
                       value="{{ old('sort_order', 0) }}"
                       min="0"
                       class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                       style="border: 2px solid #E5E7EB; color:#0F172A;"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor='#E5E7EB'"
                       placeholder="0"/>
                <p class="text-xs text-gray-400 mt-1">Lower number = shown first</p>
            </div>

            {{-- Active Status --}}
            <div class="flex items-center gap-3 p-4 rounded-xl"
                 style="background: rgba(184,134,11,0.05); border: 1px solid rgba(184,134,11,0.15);">
                <input type="checkbox"
                       name="is_active"
                       id="is_active"
                       value="1"
                       checked
                       style="width:1.125rem; height:1.125rem; accent-color:#B8860B; cursor:pointer;"/>
                <label for="is_active" class="text-sm font-medium cursor-pointer" style="color:#0F172A;">
                    Show on homepage (Active)
                </label>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold flex-1">
                    ✅ Upload Image
                </button>
                <a href="{{ route('admin.hero-images.index') }}"
                   class="btn-outline-gold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
            document.getElementById('fileName').textContent = input.files[0].name;
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('previewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function handleDrop(event) {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const input = document.getElementById('imageInput');
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        previewImage(input);
    }
}
</script>
@endpush