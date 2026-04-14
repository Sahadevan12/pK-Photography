{{-- resources/views/shop/track-order.blade.php --}}
@extends('layouts.app')
@section('title', 'Track Order')

@section('content')
<div style="min-height:80vh; display:flex; align-items:center; justify-content:center;
            padding:2rem; background:#F8FAFC;">
    <div style="max-width:480px; width:100%;">

        {{-- Header --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <div style="font-size:4rem; margin-bottom:1rem;">🔍</div>
            <h1 style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:700;
                        color:#0F172A; margin-bottom:0.5rem;">
                Track Your Order
            </h1>
            <p style="color:#6B7280; font-size:0.875rem;">
                Enter your Order ID to check status
            </p>
        </div>

        {{-- Error --}}
        @if(session('error'))
            <div style="padding:1rem; border-radius:1rem; margin-bottom:1.5rem;
                        background:#FEF2F2; border:1px solid #FECACA; color:#991B1B;
                        font-size:0.875rem; text-align:center;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Search Form --}}
        <div style="background:white; border-radius:1.5rem; padding:2rem;
                    box-shadow:0 4px 20px rgba(0,0,0,0.08); border:1px solid #F1F5F9;">
            <form action="{{ route('order.track.result') }}" method="POST">
                @csrf
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block; font-size:0.875rem; font-weight:600;
                                  color:#0F172A; margin-bottom:0.5rem;">
                        Order ID
                    </label>
                    <input type="text"
                           name="order_number"
                           value="{{ old('order_number') }}"
                           placeholder="e.g. PK2024XXXXX"
                           required
                           style="width:100%; padding:0.875rem 1rem; border-radius:0.875rem;
                                  border:2px solid #E5E7EB; font-size:1rem; outline:none;
                                  color:#0F172A; text-transform:uppercase; letter-spacing:0.05em;
                                  font-weight:600; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#B8860B'; this.style.boxShadow='0 0 0 3px rgba(184,134,11,0.15)'"
                           onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'"
                           oninput="this.value = this.value.toUpperCase()"/>
                    @error('order_number')
                        <p style="color:#EF4444; font-size:0.75rem; margin-top:0.5rem;">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                        style="width:100%; padding:1rem; border-radius:9999px; border:none;
                               font-weight:700; font-size:1rem; color:white; cursor:pointer;
                               background:linear-gradient(135deg,#7B5A00,#D4A017,#B8860B);
                               box-shadow:0 4px 15px rgba(184,134,11,0.35); transition:all 0.3s;"
                        onmouseover="this.style.transform='scale(1.02)'"
                        onmouseout="this.style.transform='scale(1)'">
                    🔍 Track Order
                </button>
            </form>
        </div>

        {{-- Help --}}
        <p style="text-align:center; margin-top:1.5rem; font-size:0.8rem; color:#9CA3AF;">
            Order ID was sent to your WhatsApp after placing order.<br>
            Need help?
            <a href="https://wa.me/919994141294" target="_blank"
               style="color:#B8860B; text-decoration:none; font-weight:600;"
               onmouseover="this.style.color='#D4A017'"
               onmouseout="this.style.color='#B8860B'">
                Contact us on WhatsApp
            </a>
        </p>
    </div>
</div>
@endsection