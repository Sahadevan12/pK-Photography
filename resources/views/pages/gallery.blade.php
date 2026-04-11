{{-- resources/views/pages/gallery.blade.php --}}
@extends('layouts.app')
@section('title', 'Gallery')

@section('content')

<section class="relative py-24 overflow-hidden" style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, rgba(212,160,23,0.1) 0%, transparent 65%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#D4A017;">Our Portfolio</p>
        <h1 class="text-5xl font-serif font-bold text-white mb-6">Photo Gallery</h1>
        <div class="gold-divider"></div>
    </div>
</section>

<section class="py-20 bg-white"
         x-data="{ active: '{{ $category }}' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filter Buttons --}}
        <div class="flex flex-wrap justify-center gap-3 mb-14">
            <a href="{{ route('gallery') }}"
               class="filter-btn px-6 py-2.5 rounded-full text-sm font-medium border-2 transition-all duration-200 {{ $category === 'all' ? 'active' : 'border-gray-200 text-gray-600 hover:border-gold hover:text-gold' }}"
               style="{{ $category === 'all' ? 'background: linear-gradient(135deg, #7B5A00, #D4A017); color: white; border-color: transparent;' : '' }}">
                All Photos
            </a>
            @foreach(['wedding', 'pre-wedding', 'portrait', 'events'] as $cat)
                <a href="{{ route('gallery', ['category' => $cat]) }}"
                   class="filter-btn px-6 py-2.5 rounded-full text-sm font-medium border-2 transition-all duration-200 {{ $category === $cat ? 'active' : 'border-gray-200 text-gray-600 hover:border-gold hover:text-gold' }}"
                   style="{{ $category === $cat ? 'background: linear-gradient(135deg, #7B5A00, #D4A017); color: white; border-color: transparent;' : '' }}">
                    {{ ucfirst($cat) }}
                </a>
            @endforeach
        </div>

        {{-- Gallery Grid --}}
        @if($images->count() > 0)
            <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-4 space-y-4">
                @foreach($images as $image)
                    <div class="break-inside-avoid group relative rounded-2xl overflow-hidden shadow-md card-hover cursor-pointer"
                         onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}', '{{ $image->title }}')">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                             alt="{{ $image->title ?? 'PK Photography' }}"
                             class="w-full object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy"/>
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-300
                                    flex flex-col items-center justify-center"
                             style="background: linear-gradient(135deg, rgba(11,17,32,0.7), rgba(184,134,11,0.3));">
                            <svg class="w-10 h-10 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            @if($image->title)
                                <p class="text-white text-sm font-medium">{{ $image->title }}</p>
                            @endif
                            <span class="mt-2 text-xs px-3 py-1 rounded-full"
                                  style="background: rgba(212,160,23,0.3); color: #FFF8E7;">
                                {{ ucfirst($image->category) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-8xl mb-6">📸</div>
                <h3 class="text-2xl font-serif font-bold text-navy mb-3">No Images Yet</h3>
                <p class="text-gray-500">Gallery images will appear here once added from the admin panel.</p>
            </div>
        @endif
    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox"
     class="fixed inset-0 z-[200] hidden items-center justify-center p-4"
     style="background: rgba(0,0,0,0.95);"
     onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-white/10">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <div onclick="event.stopPropagation()" class="max-w-4xl w-full max-h-[90vh] flex flex-col items-center">
        <img id="lightbox-img" src="" alt="" class="max-h-[80vh] w-auto rounded-2xl shadow-2xl object-contain"/>
        <p id="lightbox-caption" class="text-white mt-4 text-sm opacity-70"></p>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption || '';
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endpush