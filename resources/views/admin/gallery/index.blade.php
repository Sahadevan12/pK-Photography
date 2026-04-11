{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Gallery')
@section('page-title', '🖼️ Gallery')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">{{ $images->total() }} images total</p>
    <a href="{{ route('admin.gallery.create') }}" class="btn-gold">+ Upload Images</a>
</div>

@if($images->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach($images as $image)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm group"
                 style="border: 1px solid #F1F5F9;">
                <div class="relative" style="aspect-ratio: 1;">
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='https://via.placeholder.com/200x200/0F172A/D4A017?text=PK'"/>
                    <div class="absolute top-2 right-2">
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full capitalize text-white"
                              style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                            {{ $image->category }}
                        </span>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-xs font-medium truncate mb-2" style="color:#0F172A;">
                        {{ $image->title ?? 'No title' }}
                    </p>
                    <form action="{{ route('admin.gallery.destroy', $image->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full py-1.5 rounded-lg text-xs font-medium transition-all"
                                style="background:#FEE2E2; color:#991B1B;">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $images->links() }}</div>
@else
    <div class="bg-white rounded-2xl p-16 text-center shadow-sm" style="border: 1px solid #F1F5F9;">
        <div class="text-7xl mb-4">🖼️</div>
        <h3 class="text-xl font-bold mb-2" style="color:#0F172A; font-family:'Playfair Display',serif;">
            No Gallery Images
        </h3>
        <p class="text-gray-400 text-sm mb-6">Upload photos to display in the gallery</p>
        <a href="{{ route('admin.gallery.create') }}" class="btn-gold">+ Upload Images</a>
    </div>
@endif

@endsection