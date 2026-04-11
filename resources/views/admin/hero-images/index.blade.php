{{-- resources/views/admin/hero-images/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Hero Images')
@section('page-title', '🖼️ Hero Images')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Manage homepage hero image gallery</p>
    </div>
    <a href="{{ route('admin.hero-images.create') }}" class="btn-gold">
        + Add Hero Image
    </a>
</div>

{{-- Grid --}}
@if($heroImages->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($heroImages as $image)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm"
                 style="border: 1px solid #F1F5F9;">

                {{-- Image --}}
                <div class="relative" style="aspect-ratio: 3/4;">
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                         alt="{{ $image->title ?? 'Hero Image' }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='https://via.placeholder.com/300x400/0F172A/D4A017?text=PK+Photo'"/>

                    {{-- Sort Order Badge --}}
                    <div class="absolute top-2 left-2 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white"
                         style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                        {{ $image->sort_order }}
                    </div>

                    {{-- Status Badge --}}
                    <div class="absolute top-2 right-2">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full"
                              style="{{ $image->is_active ? 'background:#D1FAE5; color:#065F46;' : 'background:#FEE2E2; color:#991B1B;' }}">
                            {{ $image->is_active ? '✓ Active' : '✗ Hidden' }}
                        </span>
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-4">
                    <p class="text-sm font-medium text-gray-700 mb-3 truncate">
                        {{ $image->title ?? 'No Title' }}
                    </p>

                    <div class="flex items-center gap-2">
                        {{-- Toggle --}}
                        <form action="{{ route('admin.hero-images.toggle', $image->id) }}"
                              method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="w-full py-2 rounded-xl text-xs font-semibold transition-all"
                                    style="{{ $image->is_active
                                        ? 'background:#FEF3C7; color:#92400E;'
                                        : 'background:#D1FAE5; color:#065F46;' }}">
                                {{ $image->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>

                        {{-- Edit --}}
                        <a href="{{ route('admin.hero-images.edit', $image->id) }}"
                           class="p-2 rounded-xl transition-all"
                           style="background: #EFF6FF; color: #2563EB;"
                           title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('admin.hero-images.destroy', $image->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-2 rounded-xl transition-all"
                                    style="background: #FEE2E2; color: #991B1B;"
                                    title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- Empty State --}}
    <div class="bg-white rounded-2xl p-16 text-center shadow-sm"
         style="border: 1px solid #F1F5F9;">
        <div class="text-7xl mb-5">🖼️</div>
        <h3 class="text-xl font-bold mb-2" style="color:#0F172A; font-family:'Playfair Display',serif;">
            No Hero Images Yet
        </h3>
        <p class="text-gray-400 text-sm mb-6">
            Upload images to show in the homepage gallery strip
        </p>
        <a href="{{ route('admin.hero-images.create') }}" class="btn-gold">
            + Upload First Image
        </a>
    </div>
@endif

@endsection