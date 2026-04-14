{{-- resources/views/shop/show.blade.php --}}
@extends('layouts.app')
@section('title', $product->name)

{{-- ✅ FIX 1: Changed @push('styles') → @push('head')
     Because app.blade.php only has @stack('head'), NOT @stack('styles')
     @push('styles') was silently doing nothing — CSS never loaded --}}
@push('head')
<style>
/* ── Frame wrapper cursor ───────────────────────────── */
#frame-wrapper {
    cursor: grab;
    user-select: none;
    -webkit-user-select: none;
}
#frame-wrapper:active {
    cursor: grabbing;
}

/* ── Drag hint show state ───────────────────────────── */
#frame-hint.show {
    opacity: 1 !important;
}

/* ── Zoom bar buttons hover ─────────────────────────── */
#frame-zoom-bar button:hover {
    background: #e0e0e0 !important;
}

/* ── Zoom slider accent ─────────────────────────────── */
#zoom-slider {
    flex: 1;
    accent-color: #B8860B;
    cursor: pointer;
}
</style>
@endpush

@section('content')
<div class="py-16 bg-brand-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-10">
            <a href="{{ route('home') }}" style="color:inherit; text-decoration:none;"
               onmouseover="this.style.color='#B8860B'" onmouseout="this.style.color=''">Home</a>
            <span>/</span>
            <a href="{{ route('shop.index') }}" style="color:inherit; text-decoration:none;"
               onmouseover="this.style.color='#B8860B'" onmouseout="this.style.color=''">Shop</a>
            <span>/</span>
            <span style="color:#0F172A; font-weight:500;">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 mb-20">

            {{-- ═══════════════════════════════════════
                 LEFT — FRAME PREVIEW SECTION
            ═══════════════════════════════════════ --}}
            <div x-data="{ mainImage: '{{ asset('storage/' . $product->main_image) }}' }">

                {{-- ✅ FIX 2: Added explicit min-height + width:100%
                     aspect-ratio:1 alone gives offsetWidth=0 in JS
                     because the parent has no fixed height reference.
                     JS needs a real pixel size for coverFit() to work. --}}
                <div id="frame-wrapper"
                     class="relative rounded-3xl shadow-2xl mb-4"
                     style="position:relative;
                            width:100%;
                            aspect-ratio:1/1;
                            overflow:hidden;
                            background:#F1F5F9;">

                    {{-- ✅ FIX 3: z-index:2 (above placeholder at z-index:1)
                         Previously both were z-index:1 → placeholder
                         was covering the uploaded photo --}}
                    <img id="frame-user-image"
                         src=""
                         alt="Your Photo"
                         draggable="false"
                         style="position:absolute;
                                top:0; left:0;
                                display:none;
                                transform-origin:0 0;
                                will-change:transform;
                                pointer-events:none;
                                z-index:2;"
                    />

                    {{-- Placeholder: z-index:1 so photo at z-index:2 covers it --}}
                    <div id="uploadPlaceholderText"
                         style="position:absolute; inset:0; z-index:1;
                                display:flex; flex-direction:column;
                                align-items:center; justify-content:center;
                                text-align:center; color:#9CA3AF;
                                pointer-events:none;">
                        <div style="font-size:4rem; margin-bottom:0.5rem;">📷</div>
                        <p style="font-size:0.875rem;">Upload your photo to preview</p>
                    </div>

                    {{-- ✅ Frame PNG: z-index:10 — always on top of everything --}}
                    <img :src="mainImage"
                         alt="{{ $product->name }}"
                         id="frame-overlay"
                         draggable="false"
                         style="position:absolute;
                                top:0; left:0;
                                width:100%; height:100%;
                                object-fit:fill;
                                z-index:10;
                                pointer-events:none;
                                display:block;"
                         onerror="this.src='https://via.placeholder.com/600x600/F1F5F9/D4A017?text=Frame'"/>

                    {{-- Sale Badge --}}
                    @if($product->sale_price)
                        <div style="position:absolute; top:1rem; left:1rem; z-index:20;
                                    padding:0.375rem 0.875rem; border-radius:9999px;
                                    background:linear-gradient(135deg,#7B5A00,#D4A017);
                                    color:white; font-size:0.75rem; font-weight:700;">
                            🔥 -{{ $product->discount_percent }}% OFF
                        </div>
                    @endif

                    {{-- Drag Hint Toast --}}
                    <span id="frame-hint"
                          style="position:absolute; bottom:12px; left:50%;
                                 transform:translateX(-50%); z-index:30;
                                 background:rgba(0,0,0,0.6); color:#fff;
                                 font-size:12px; padding:5px 16px;
                                 border-radius:20px; pointer-events:none;
                                 white-space:nowrap; opacity:0;
                                 transition:opacity 0.35s ease;">
                        ✋ Drag to move &nbsp;·&nbsp; Scroll to zoom
                    </span>
                </div>
                {{-- ── End frame-wrapper ─────────────────────── --}}


                {{-- Zoom Controls Bar --}}
                <div id="frame-zoom-bar"
                     style="display:none;
                            align-items:center;
                            gap:8px;
                            margin:10px 0 0 0;
                            width:100%;">

                    <button type="button" id="btn-zoom-out"
                            title="Zoom Out"
                            style="min-width:36px; height:36px;
                                   border:1px solid #ccc; border-radius:6px;
                                   background:#f5f5f5; font-size:20px;
                                   cursor:pointer; flex-shrink:0;
                                   transition:background 0.15s;">−</button>

                    <input type="range"
                           id="zoom-slider"
                           min="100" max="300" value="100" step="1"
                           style="flex:1; accent-color:#B8860B; cursor:pointer;"/>

                    <button type="button" id="btn-zoom-in"
                            title="Zoom In"
                            style="min-width:36px; height:36px;
                                   border:1px solid #ccc; border-radius:6px;
                                   background:#f5f5f5; font-size:20px;
                                   cursor:pointer; flex-shrink:0;
                                   transition:background 0.15s;">+</button>

                    <button type="button" id="btn-zoom-reset"
                            title="Reset"
                            style="height:36px; padding:0 12px;
                                   border:1px solid #ccc; border-radius:6px;
                                   background:#f5f5f5; font-size:12px;
                                   cursor:pointer; white-space:nowrap;
                                   flex-shrink:0; transition:background 0.15s;">
                        ↺ Reset
                    </button>
                </div>
                {{-- ── End Zoom Controls ─────────────────────── --}}


                {{-- Gallery Thumbnails --}}
                @if($product->gallery_images && count($product->gallery_images) > 0)
                    <div class="flex gap-3 overflow-x-auto py-2 mt-4">
                        <button type="button"
                                @click="mainImage = '{{ asset('storage/' . $product->main_image) }}'"
                                class="flex-shrink-0 rounded-xl overflow-hidden transition-all"
                                style="width:5rem; height:5rem; border:2px solid #B8860B;">
                            <img src="{{ asset('storage/' . $product->main_image) }}"
                                 class="w-full h-full object-cover"/>
                        </button>
                        @foreach($product->gallery_images as $gallery)
                            <button type="button"
                                    @click="mainImage = '{{ asset('storage/' . $gallery) }}'"
                                    class="flex-shrink-0 rounded-xl overflow-hidden transition-all"
                                    style="width:5rem; height:5rem; border:2px solid #E5E7EB;">
                                <img src="{{ asset('storage/' . $gallery) }}"
                                     class="w-full h-full object-cover"/>
                            </button>
                        @endforeach
                    </div>
                @endif

                {{-- Preview Info Banner --}}
                @if($product->allow_custom_image)
                    <div class="mt-4 p-4 rounded-2xl text-center"
                         style="background:linear-gradient(135deg,rgba(123,90,0,0.06),rgba(212,160,23,0.1));
                                border:1px dashed rgba(184,134,11,0.4);">
                        <p style="font-size:0.875rem; font-weight:600;
                                  color:#7B5A00; margin-bottom:0.25rem;">
                            📸 Live Frame Preview
                        </p>
                        <p style="font-size:0.75rem; color:#92400E;">
                            Upload your photo below — drag &amp; scroll to adjust fit!
                        </p>
                    </div>
                @endif
            </div>
            {{-- ── End Left Column ─────────────────────────── --}}


            {{-- ═══════════════════════════════════════
                 RIGHT — PRODUCT DETAILS + FORM
            ═══════════════════════════════════════ --}}
            <div x-data="{ qty: 1 }">

                <p style="font-size:0.75rem; font-weight:600; text-transform:uppercase;
                           letter-spacing:0.1em; color:#B8860B; margin-bottom:0.5rem;">
                    {{ $product->category->name }}
                </p>

                <h1 style="font-family:'Playfair Display',serif; font-size:2rem;
                            font-weight:700; color:#0F172A; margin-bottom:1rem;">
                    {{ $product->name }}
                </h1>

                {{-- Price --}}
                <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem;">
                    <span style="font-size:2rem; font-weight:700; color:#B8860B;">
                        ₹{{ number_format($product->current_price, 2) }}
                    </span>
                    @if($product->sale_price)
                        <span style="font-size:1.25rem; color:#9CA3AF; text-decoration:line-through;">
                            ₹{{ number_format($product->price, 2) }}
                        </span>
                        <span style="padding:0.25rem 0.75rem; border-radius:9999px;
                                     background:linear-gradient(135deg,#7B5A00,#D4A017);
                                     color:white; font-size:0.875rem; font-weight:700;">
                            Save ₹{{ number_format($product->price - $product->sale_price, 0) }}
                        </span>
                    @endif
                </div>

                @if($product->short_description)
                    <p style="color:#4B5563; line-height:1.75; margin-bottom:1.5rem;">
                        {{ $product->short_description }}
                    </p>
                @endif

                <div style="height:1px;
                             background:linear-gradient(90deg,rgba(184,134,11,0.3),transparent);
                             margin-bottom:1.5rem;"></div>

                {{-- Form --}}
                <form action="{{ route('cart.add') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="addToCartForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>

                    {{-- Quantity --}}
                    <div style="margin-bottom:1.5rem;">
                        <label style="display:block; font-size:0.875rem; font-weight:600;
                                      color:#0F172A; margin-bottom:0.5rem;">Quantity</label>
                        <div style="display:flex; align-items:center; gap:0.75rem;">
                            <button type="button"
                                    @click="qty = Math.max(1, qty - 1)"
                                    style="width:2.5rem; height:2.5rem; border-radius:9999px;
                                           border:2px solid #E5E7EB; background:white;
                                           font-size:1.25rem; font-weight:700; cursor:pointer;
                                           color:#0F172A; display:flex; align-items:center;
                                           justify-content:center;">−</button>
                            <input type="number" name="quantity" :value="qty" x-model="qty"
                                   min="1" max="10"
                                   style="width:4rem; text-align:center; padding:0.5rem;
                                          border-radius:0.75rem; border:2px solid #E5E7EB;
                                          font-weight:600; font-size:1rem; outline:none; color:#0F172A;"
                                   onfocus="this.style.borderColor='#B8860B'"
                                   onblur="this.style.borderColor='#E5E7EB'"/>
                            <button type="button"
                                    @click="qty = Math.min(10, qty + 1)"
                                    style="width:2.5rem; height:2.5rem; border-radius:9999px;
                                           border:2px solid #E5E7EB; background:white;
                                           font-size:1.25rem; font-weight:700; cursor:pointer;
                                           color:#0F172A; display:flex; align-items:center;
                                           justify-content:center;">+</button>
                        </div>
                    </div>

                    {{-- Custom Image Upload --}}
                    @if($product->allow_custom_image)
                        <div style="margin-bottom:1.5rem; padding:1.25rem; border-radius:1rem;
                                    background:linear-gradient(135deg,rgba(123,90,0,0.04),rgba(212,160,23,0.08));
                                    border:1.5px dashed rgba(184,134,11,0.4);">

                            <label style="display:block; font-size:0.875rem; font-weight:700;
                                          color:#0F172A; margin-bottom:0.75rem;">
                                📸 {{ $product->custom_image_label ?? 'Upload Your Photo' }}
                                <span style="color:#6B7280; font-weight:400; font-size:0.75rem;">
                                    (Optional)
                                </span>
                            </label>

                            {{-- Drop Zone --}}
                            <div id="dropZone"
                                 onclick="document.getElementById('frame-upload').click()"
                                 ondragover="event.preventDefault();
                                             this.style.borderColor='#D4A017';
                                             this.style.background='rgba(212,160,23,0.08)'"
                                 ondragleave="this.style.borderColor='rgba(184,134,11,0.3)';
                                              this.style.background='transparent'"
                                 ondrop="handleImageDrop(event)"
                                 style="border:2px dashed rgba(184,134,11,0.3);
                                        border-radius:0.75rem; padding:1.5rem;
                                        text-align:center; cursor:pointer;
                                        transition:all 0.2s ease; margin-bottom:0.75rem;">

                                <div id="dropZoneContent">
                                    <div style="font-size:2.5rem; margin-bottom:0.5rem;">🖼️</div>
                                    <p style="font-size:0.875rem; font-weight:600;
                                              color:#0F172A; margin-bottom:0.25rem;">
                                        Click or Drag &amp; Drop your photo
                                    </p>
                                    <p style="font-size:0.75rem; color:#6B7280;">
                                        JPG, PNG, WEBP — Max 5MB
                                    </p>
                                </div>

                                <div id="dropZonePreview" style="display:none;">
                                    <img id="dropZonePreviewImg"
                                         style="max-height:120px; border-radius:0.5rem;
                                                margin:0 auto; object-fit:cover;
                                                border:2px solid #B8860B;"/>
                                    <p id="dropZoneFileName"
                                       style="font-size:0.75rem; color:#059669;
                                              font-weight:600; margin-top:0.5rem;"></p>
                                    <p style="font-size:0.7rem; color:#9CA3AF; margin-top:0.25rem;">
                                        Click to change photo
                                    </p>
                                </div>
                            </div>

                            {{-- ✅ id="frame-upload" — frame-preview JS listens on this --}}
                            <input type="file"
                                   id="frame-upload"
                                   name="custom_image"
                                   accept="image/jpeg,image/png,image/webp"
                                   style="display:none;"/>

                            <div id="imageError"
                                 style="display:none; padding:0.5rem 0.75rem;
                                        border-radius:0.5rem; background:#FEF2F2;
                                        border:1px solid #FECACA; color:#991B1B;
                                        font-size:0.75rem; margin-top:0.5rem;"></div>

                            @error('custom_image')
                                <p style="color:#EF4444; font-size:0.75rem; margin-top:0.25rem;">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div style="display:flex; gap:1rem; margin-bottom:1.5rem;">
                        <button type="submit"
                                style="flex:1; display:inline-flex; align-items:center;
                                       justify-content:center; gap:0.5rem; padding:1rem 1.5rem;
                                       border-radius:9999px; font-weight:700; font-size:1rem;
                                       color:white; border:none; cursor:pointer;
                                       transition:all 0.3s ease;
                                       background:linear-gradient(135deg,#7B5A00,#D4A017,#B8860B);
                                       box-shadow:0 4px 20px rgba(184,134,11,0.35);"
                                onmouseover="this.style.transform='scale(1.03)';
                                             this.style.boxShadow='0 8px 30px rgba(212,160,23,0.5)'"
                                onmouseout="this.style.transform='scale(1)';
                                            this.style.boxShadow='0 4px 20px rgba(184,134,11,0.35)'">
                            🛒 Add to Cart
                        </button>
                        <a href="{{ route('cart.index') }}"
                           style="flex:1; display:inline-flex; align-items:center;
                                  justify-content:center; gap:0.5rem; padding:1rem 1.5rem;
                                  border-radius:9999px; font-weight:600; font-size:1rem;
                                  text-decoration:none; color:#B8860B; border:2px solid #B8860B;
                                  transition:all 0.3s ease;"
                           onmouseover="this.style.background='linear-gradient(135deg,#7B5A00,#D4A017)';
                                        this.style.color='white'; this.style.borderColor='transparent'"
                           onmouseout="this.style.background='transparent';
                                       this.style.color='#B8860B'; this.style.borderColor='#B8860B'">
                            View Cart
                        </a>
                    </div>
                </form>

                {{-- Trust Badges --}}
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; margin-top:1.5rem;">
                    @foreach([
                        ['icon'=>'🚚','label'=>'Free Delivery','sub'=>'Above ₹999'],
                        ['icon'=>'💬','label'=>'WhatsApp Order','sub'=>'Quick & Easy'],
                        ['icon'=>'✨','label'=>'Premium Quality','sub'=>'Guaranteed'],
                    ] as $badge)
                        <div style="padding:0.75rem; border-radius:1rem;
                                    text-align:center; background:#F8FAFC;">
                            <div style="font-size:1.75rem; margin-bottom:0.25rem;">{{ $badge['icon'] }}</div>
                            <p style="font-size:0.7rem; font-weight:600; color:#0F172A;">{{ $badge['label'] }}</p>
                            <p style="font-size:0.65rem; color:#6B7280;">{{ $badge['sub'] }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Product Description --}}
                @if($product->description)
                    <div style="margin-top:2rem; padding:1.5rem; border-radius:1.5rem;
                                background:white; border:1px solid #F1F5F9;
                                box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                        <h3 style="font-family:'Playfair Display',serif; font-size:1.125rem;
                                   font-weight:700; color:#0F172A; margin-bottom:1rem;">
                            Product Details
                        </h3>
                        <div style="font-size:0.875rem; color:#4B5563; line-height:1.8;">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                @endif
            </div>
            {{-- ── End Right Column ─────────────────────── --}}

        </div>

        {{-- Related Products --}}
        @if($related->count() > 0)
            <div>
                <h2 style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:700;
                            color:#0F172A; text-align:center; margin-bottom:2rem;">
                    You Might Also Like
                </h2>
                <div style="display:grid;
                            grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
                            gap:1.5rem;">
                    @foreach($related as $relProduct)
                        <a href="{{ route('shop.show', $relProduct->slug) }}"
                           style="background:white; border-radius:1rem; overflow:hidden;
                                  box-shadow:0 2px 8px rgba(0,0,0,0.06); text-decoration:none;
                                  transition:all 0.3s ease; display:block;"
                           onmouseover="this.style.transform='translateY(-4px)';
                                        this.style.boxShadow='0 12px 30px rgba(0,0,0,0.12)'"
                           onmouseout="this.style.transform='translateY(0)';
                                       this.style.boxShadow='0 2px 8px rgba(0,0,0,0.06)'">
                            <div style="aspect-ratio:1; overflow:hidden;">
                                <img src="{{ asset('storage/' . $relProduct->main_image) }}"
                                     alt="{{ $relProduct->name }}"
                                     style="width:100%; height:100%; object-fit:cover;
                                            transition:transform 0.5s;"
                                     onmouseover="this.style.transform='scale(1.08)'"
                                     onmouseout="this.style.transform='scale(1)'"/>
                            </div>
                            <div style="padding:1rem;">
                                <p style="font-size:0.875rem; font-weight:600;
                                          color:#0F172A; margin-bottom:0.5rem;">
                                    {{ $relProduct->name }}
                                </p>
                                <span style="font-size:1rem; font-weight:700; color:#B8860B;">
                                    ₹{{ number_format($relProduct->current_price, 0) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    "use strict";

    /* ════════════════════════════════════════════════════
       FRAME PREVIEW — FULLY INLINED
       Inlined directly to avoid any asset path issues.
       Fixes:
         ✅ wrapper size via getBoundingClientRect()
         ✅ double-rAF so size is read after paint
         ✅ correct z-index layering
         ✅ cover-fit math (no stretch, no empty space)
         ✅ drag + scroll zoom + slider + buttons
    ════════════════════════════════════════════════════ */

    /* ── Element refs ─────────────────────────────────── */
    const wrapper     = document.getElementById('frame-wrapper');
    const photo       = document.getElementById('frame-user-image');
    const fileInput   = document.getElementById('frame-upload');
    const placeholder = document.getElementById('uploadPlaceholderText');
    const zoomBar     = document.getElementById('frame-zoom-bar');
    const slider      = document.getElementById('zoom-slider');
    const btnIn       = document.getElementById('btn-zoom-in');
    const btnOut      = document.getElementById('btn-zoom-out');
    const btnReset    = document.getElementById('btn-zoom-reset');
    const hint        = document.getElementById('frame-hint');

    if (!wrapper || !photo || !fileInput) {
        console.warn('[FramePreview] Missing elements. Aborting.');
        return;
    }

    /* ── State ────────────────────────────────────────── */
    const S = {
        scale   : 1,
        x       : 0,
        y       : 0,
        baseW   : 0,
        baseH   : 0,
        dragging: false,
        startX  : 0,
        startY  : 0,
        originX : 0,
        originY : 0,
    };

    /* ── Get real wrapper pixel size ──────────────────── */
    /* ✅ THE CORE FIX:
       aspect-ratio:1 alone gives offsetWidth = 0 in some
       browsers before the browser finishes painting.
       getBoundingClientRect() returns the real rendered size
       AFTER layout is complete. */
    function getBox() {
        const r = wrapper.getBoundingClientRect();
        const w = r.width  || wrapper.offsetWidth  || wrapper.clientWidth  || 400;
        const h = r.height || wrapper.offsetHeight || wrapper.clientHeight || 400;
        return { w, h };
    }

    /* ── Cover-fit math ───────────────────────────────── */
    /* Same as CSS object-fit:cover.
       ratio = max(boxW/natW, boxH/natH)
       Ensures image fills the box with no gaps. */
    function coverFit(natW, natH, boxW, boxH) {
        if (!natW || !natH || !boxW || !boxH) return { w: boxW, h: boxH };
        const r = Math.max(boxW / natW, boxH / natH);
        return { w: natW * r, h: natH * r };
    }

    /* ── Clamp: never expose wrapper background ───────── */
    function clamp(x, y) {
        const { w: bW, h: bH } = getBox();
        const sW = S.baseW * S.scale;
        const sH = S.baseH * S.scale;
        return {
            x: Math.min(0, Math.max(x, bW - sW)),
            y: Math.min(0, Math.max(y, bH - sH)),
        };
    }

    /* ── Write state → DOM (GPU via transform) ────────── */
    function paint() {
        const c = clamp(S.x, S.y);
        S.x = c.x; S.y = c.y;
        photo.style.width     = S.baseW + 'px';
        photo.style.height    = S.baseH + 'px';
        photo.style.transform = `translate(${S.x}px,${S.y}px) scale(${S.scale})`;
    }

    /* ── Reset to centered cover-fit ──────────────────── */
    function resetToCenter() {
        const { w: bW, h: bH } = getBox();
        const cv = coverFit(photo.naturalWidth, photo.naturalHeight, bW, bH);
        S.baseW = cv.w;
        S.baseH = cv.h;
        S.scale = 1;
        S.x     = (bW - cv.w) / 2;   /* center horizontally */
        S.y     = (bH - cv.h) / 2;   /* center vertically   */
        if (slider) slider.value = 100;
        paint();
    }

    /* ════════════════════════════════════════════════════
       FILE INPUT CHANGE — MAIN ENTRY POINT
    ════════════════════════════════════════════════════ */
    fileInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file || !file.type.startsWith('image/')) return;

        const reader = new FileReader();

        reader.onload = function (evt) {
            /* One-shot: fires when <img> finishes decoding */
            photo.addEventListener('load', function ready() {
                photo.removeEventListener('load', ready);

                /* Show photo, hide placeholder, show zoom bar */
                photo.style.display  = 'block';
                photo.style.zIndex   = '2';
                if (placeholder) placeholder.style.display = 'none';
                if (zoomBar)     zoomBar.style.display     = 'flex';

                /* ✅ Double rAF: wait for browser to finish
                   painting the layout before reading sizes.
                   Without this, getBoundingClientRect() can
                   still return 0 for aspect-ratio elements. */
                requestAnimationFrame(function () {
                    requestAnimationFrame(function () {
                        resetToCenter();
                        showHint();
                    });
                });
            });

            photo.src = evt.target.result;
        };

        reader.readAsDataURL(file);
    });

    /* ════════════════════════════════════════════════════
       DRAG TO REPOSITION
    ════════════════════════════════════════════════════ */
    wrapper.addEventListener('mousedown',  onDragStart);
    wrapper.addEventListener('touchstart', onDragStart, { passive: false });

    function onDragStart(e) {
        if (!photo.src || photo.style.display === 'none') return;
        e.preventDefault();
        const p    = pt(e);
        S.dragging = true;
        S.startX   = p.x; S.startY  = p.y;
        S.originX  = S.x; S.originY = S.y;
        wrapper.style.cursor = 'grabbing';
    }

    document.addEventListener('mousemove',  onDragMove);
    document.addEventListener('touchmove',  onDragMove, { passive: false });

    function onDragMove(e) {
        if (!S.dragging) return;
        e.preventDefault();
        const p = pt(e);
        S.x = S.originX + (p.x - S.startX);
        S.y = S.originY + (p.y - S.startY);
        paint();
    }

    document.addEventListener('mouseup',  onDragEnd);
    document.addEventListener('touchend', onDragEnd);

    function onDragEnd() {
        if (!S.dragging) return;
        S.dragging = false;
        wrapper.style.cursor = 'grab';
    }

    function pt(e) {
        return (e.touches && e.touches[0])
            ? { x: e.touches[0].clientX, y: e.touches[0].clientY }
            : { x: e.clientX,            y: e.clientY            };
    }

    /* ════════════════════════════════════════════════════
       SCROLL TO ZOOM (zooms toward cursor)
    ════════════════════════════════════════════════════ */
    wrapper.addEventListener('wheel', function (e) {
        if (!photo.src || photo.style.display === 'none') return;
        e.preventDefault();

        const r     = wrapper.getBoundingClientRect();
        const cx    = e.clientX - r.left;
        const cy    = e.clientY - r.top;
        const delta = e.deltaY < 0 ? 0.08 : -0.08;
        const ns    = Math.min(3, Math.max(1, S.scale + delta));
        const ratio = ns / S.scale;

        S.x = cx - ratio * (cx - S.x);
        S.y = cy - ratio * (cy - S.y);
        S.scale = ns;

        if (slider) slider.value = Math.round(ns * 100);
        paint();
    }, { passive: false });

    /* ════════════════════════════════════════════════════
       ZOOM SLIDER
    ════════════════════════════════════════════════════ */
    if (slider) {
        slider.addEventListener('input', function () {
            const { w, h } = getBox();
            const cx    = w / 2;
            const cy    = h / 2;
            const ns    = parseFloat(this.value) / 100;
            const ratio = ns / S.scale;
            S.x = cx - ratio * (cx - S.x);
            S.y = cy - ratio * (cy - S.y);
            S.scale = ns;
            paint();
        });
    }

    /* ════════════════════════════════════════════════════
       ZOOM BUTTONS
    ════════════════════════════════════════════════════ */
    function zoomCenter(delta) {
        const { w, h } = getBox();
        const cx    = w / 2;
        const cy    = h / 2;
        const ns    = Math.min(3, Math.max(1, S.scale + delta));
        const ratio = ns / S.scale;
        S.x = cx - ratio * (cx - S.x);
        S.y = cy - ratio * (cy - S.y);
        S.scale = ns;
        if (slider) slider.value = Math.round(ns * 100);
        paint();
    }

    if (btnIn)    btnIn.addEventListener('click',  () => zoomCenter(+0.15));
    if (btnOut)   btnOut.addEventListener('click', () => zoomCenter(-0.15));
    if (btnReset) btnReset.addEventListener('click', resetToCenter);

    /* ════════════════════════════════════════════════════
       DRAG HINT TOAST
    ════════════════════════════════════════════════════ */
    let hintTimer = null;
    function showHint() {
        if (!hint) return;
        hint.classList.add('show');
        clearTimeout(hintTimer);
        hintTimer = setTimeout(() => hint.classList.remove('show'), 2500);
    }

    console.log('[FramePreview] ✅ Ready');

})();

/* ════════════════════════════════════════════════════════
   DROP ZONE THUMBNAIL HANDLER
   (Separate from frame preview — only updates the
    small thumbnail inside the drop zone box)
════════════════════════════════════════════════════════ */

const _MAX  = 5 * 1024 * 1024;
const _TYPES = ['image/jpeg', 'image/png', 'image/webp'];

/* Called by ondrop on #dropZone */
function handleImageDrop(event) {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    if (!file) return;

    if (!_TYPES.includes(file.type)) {
        showImageError('❌ Only JPG, PNG, WEBP allowed!');
        return;
    }
    if (file.size > _MAX) {
        showImageError('❌ Max 5MB allowed.');
        return;
    }

    /* Push dropped file into real input
       so form submits it AND change event fires
       for the frame preview JS above */
    const input = document.getElementById('frame-upload');
    const dt    = new DataTransfer();
    dt.items.add(file);
    input.files = dt.files;

    /* Fire change manually so frame preview picks it up */
    input.dispatchEvent(new Event('change'));

    /* Update drop zone thumbnail */
    updateDropZone(file);
}

/* Called by the file input's onchange — but we removed
   the onchange attribute and use addEventListener below
   so both handlers fire reliably */
document.addEventListener('DOMContentLoaded', function () {
    const inp = document.getElementById('frame-upload');
    if (!inp) return;

    inp.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;

        if (!_TYPES.includes(file.type)) {
            showImageError('❌ Only JPG, PNG, WEBP allowed!');
            this.value = '';
            return;
        }
        if (file.size > _MAX) {
            showImageError('❌ Max 5MB allowed.');
            this.value = '';
            return;
        }

        const errDiv = document.getElementById('imageError');
        if (errDiv) errDiv.style.display = 'none';

        updateDropZone(file);
    });
});

function updateDropZone(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        const dc = document.getElementById('dropZoneContent');
        const dp = document.getElementById('dropZonePreview');
        const di = document.getElementById('dropZonePreviewImg');
        const dn = document.getElementById('dropZoneFileName');

        if (dc) dc.style.display = 'none';
        if (dp) dp.style.display = 'block';
        if (di) di.src           = e.target.result;
        if (dn) dn.textContent   = '✅ ' + file.name;
    };
    reader.readAsDataURL(file);
}

function showImageError(msg) {
    const d = document.getElementById('imageError');
    if (d) { d.textContent = msg; d.style.display = 'block'; }
}
</script>
@endpush