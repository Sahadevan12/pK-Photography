{{-- resources/views/shop/whatsapp-redirect.blade.php --}}
@extends('layouts.app')
@section('title', 'Order Placed!')

@section('content')
<div style="min-height:80vh; display:flex; align-items:center; justify-content:center;
            padding:2rem; background:#F8FAFC;">
    <div style="max-width:520px; width:100%; text-align:center;">

        {{-- Success Icon --}}
        <div style="width:6rem; height:6rem; border-radius:50%; margin:0 auto 1.5rem;
                    display:flex; align-items:center; justify-content:center; font-size:3rem;
                    background:linear-gradient(135deg,#D1FAE5,#A7F3D0);
                    box-shadow:0 8px 25px rgba(16,185,129,0.3);">
            ✅
        </div>

        <h1 style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:700;
                    color:#0F172A; margin-bottom:0.5rem;">
            Order Placed!
        </h1>

        <p style="color:#6B7280; margin-bottom:1.5rem;">
            Your order has been received successfully.
        </p>

        {{-- Order ID Card --}}
        <div style="background:white; border-radius:1.5rem; padding:1.5rem; margin-bottom:1.5rem;
                    box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #F1F5F9;">
            <p style="font-size:0.75rem; color:#9CA3AF; margin-bottom:0.25rem; text-transform:uppercase; letter-spacing:0.1em;">
                Your Order ID
            </p>
            <p style="font-size:1.75rem; font-weight:800; letter-spacing:0.1em;"
               style="background:linear-gradient(135deg,#7B5A00,#D4A017,#B8860B);
                      -webkit-background-clip:text; -webkit-text-fill-color:transparent;">
                <span style="color:#B8860B;">{{ $order->order_number }}</span>
            </p>
            <p style="font-size:0.75rem; color:#9CA3AF; margin-top:0.5rem;">
                📌 Save this ID to track your order
            </p>
        </div>

        {{-- Order Summary --}}
        <div style="background:white; border-radius:1.5rem; padding:1.5rem; margin-bottom:1.5rem;
                    box-shadow:0 2px 8px rgba(0,0,0,0.05); border:1px solid #F1F5F9; text-align:left;">
            <p style="font-weight:700; color:#0F172A; margin-bottom:1rem; font-size:0.875rem;">
                📦 Order Summary
            </p>
            @foreach($order->items as $item)
                <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.75rem;
                             padding-bottom:0.75rem; border-bottom:1px solid #F8FAFC;">
                    @if($item->product)
                        <img src="{{ asset('storage/' . $item->product->main_image) }}"
                             style="width:3rem; height:3rem; border-radius:0.5rem; object-fit:cover;"/>
                    @endif
                    <div style="flex:1;">
                        <p style="font-size:0.875rem; font-weight:600; color:#0F172A;">
                            {{ $item->product_name }}
                        </p>
                        <p style="font-size:0.75rem; color:#9CA3AF;">
                            Qty: {{ $item->quantity }}
                            @if($item->custom_image_path)
                                · 📸 Custom photo included
                            @endif
                        </p>
                    </div>
                    <span style="font-weight:700; color:#B8860B;">
                        ₹{{ number_format($item->total, 0) }}
                    </span>
                </div>
            @endforeach
            <div style="display:flex; justify-content:space-between; font-weight:800; font-size:1.125rem;">
                <span style="color:#0F172A;">Total</span>
                <span style="color:#B8860B;">₹{{ number_format($order->total, 0) }}</span>
            </div>
        </div>

        {{-- Buttons --}}
        <div style="display:flex; flex-direction:column; gap:0.75rem;">

            {{-- WhatsApp Button --}}
            <a href="{{ $waUrl }}"
               target="_blank"
               style="display:flex; align-items:center; justify-content:center; gap:0.75rem;
                      padding:1rem; border-radius:9999px; font-weight:700; color:white;
                      text-decoration:none; font-size:1rem; transition:all 0.3s;
                      background:linear-gradient(135deg,#25D366,#128C7E);
                      box-shadow:0 4px 20px rgba(37,211,102,0.4);"
               onmouseover="this.style.transform='scale(1.03)'"
               onmouseout="this.style.transform='scale(1)'">
                <svg style="width:1.5rem; height:1.5rem; fill:white;" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                </svg>
                Confirm Order on WhatsApp
            </a>

            {{-- Track Order --}}
            <a href="{{ route('order.track') }}"
               style="display:flex; align-items:center; justify-content:center; gap:0.5rem;
                      padding:0.875rem; border-radius:9999px; font-weight:600; font-size:0.875rem;
                      text-decoration:none; color:#B8860B; border:2px solid #B8860B;
                      transition:all 0.2s;"
               onmouseover="this.style.background='rgba(184,134,11,0.08)'"
               onmouseout="this.style.background='transparent'">
                🔍 Track My Order
            </a>

            {{-- Continue Shopping --}}
            <a href="{{ route('shop.index') }}"
               style="color:#9CA3AF; font-size:0.875rem; text-decoration:none;"
               onmouseover="this.style.color='#B8860B'"
               onmouseout="this.style.color='#9CA3AF'">
                ← Continue Shopping
            </a>
        </div>
    </div>
</div>
@endsection