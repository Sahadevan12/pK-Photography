{{-- resources/views/shop/checkout.blade.php --}}
@extends('layouts.app')
@section('title', 'Checkout')

@section('content')

<div class="py-16 bg-brand-bg min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-4xl font-serif font-bold text-navy mb-10">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- Checkout Form --}}
            <div>
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h2 class="text-xl font-serif font-bold text-navy mb-6 pb-4 border-b border-gray-100">
                        📦 Delivery Details
                    </h2>

                    <form action="{{ route('checkout.place') }}" method="POST" id="checkoutForm">
                        @csrf

                        <div class="space-y-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-navy mb-2">Full Name *</label>
                                    <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm"
                                           onfocus="this.style.borderColor='#B8860B'"
                                           onblur="this.style.borderColor=''"
                                           placeholder="Your full name"/>
                                    @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-navy mb-2">Phone (WhatsApp) *</label>
                                    <input type="tel" name="customer_phone" required value="{{ old('customer_phone') }}"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm"
                                           onfocus="this.style.borderColor='#B8860B'"
                                           onblur="this.style.borderColor=''"
                                           placeholder="+91 XXXXX XXXXX"/>
                                    @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-navy mb-2">Email Address</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm"
                                       onfocus="this.style.borderColor='#B8860B'"
                                       onblur="this.style.borderColor=''"
                                       placeholder="your@email.com (optional)"/>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-navy mb-2">Delivery Address *</label>
                                <textarea name="customer_address" required rows="3"
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm resize-none"
                                          onfocus="this.style.borderColor='#B8860B'"
                                          onblur="this.style.borderColor=''"
                                          placeholder="House No., Street, Area...">{{ old('customer_address') }}</textarea>
                                @error('customer_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-navy mb-2">City *</label>
                                    <input type="text" name="city" required value="{{ old('city') }}"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm"
                                           onfocus="this.style.borderColor='#B8860B'"
                                           onblur="this.style.borderColor=''"
                                           placeholder="Chennai"/>
                                    @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-navy mb-2">PIN Code *</label>
                                    <input type="text" name="pincode" required value="{{ old('pincode') }}"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm"
                                           onfocus="this.style.borderColor='#B8860B'"
                                           onblur="this.style.borderColor=''"
                                           placeholder="600001"/>
                                    @error('pincode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-navy mb-2">Order Notes</label>
                                <textarea name="notes" rows="2"
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none text-sm resize-none"
                                          onfocus="this.style.borderColor='#B8860B'"
                                          onblur="this.style.borderColor=''"
                                          placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        {{-- WhatsApp Info --}}
                        <div class="mt-7 p-5 rounded-2xl"
                             style="background: linear-gradient(135deg, rgba(37,211,102,0.05), rgba(18,140,126,0.08)); border: 1px solid rgba(37,211,102,0.2);">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 flex-shrink-0 mt-0.5" style="color:#25D366;" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-sm text-navy">Order via WhatsApp</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        After placing, you'll be redirected to WhatsApp to confirm your order with us directly. 
                                        Quick, simple, and secure!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                                class="mt-8 w-full flex items-center justify-center gap-3 py-4 rounded-2xl font-semibold text-white text-base transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                                style="background: linear-gradient(135deg, #25D366, #128C7E); box-shadow: 0 4px 20px rgba(37,211,102,0.3);">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                            </svg>
                            Place Order via WhatsApp
                        </button>
                    </form>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-3xl p-8 shadow-sm sticky top-28">
                    <h2 class="text-xl font-serif font-bold text-navy mb-6 pb-4 border-b border-gray-100">
                        🛍️ Order Summary
                    </h2>

                    <div class="space-y-4 mb-6">
                        @foreach($cart as $rowId => $item)
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('storage/' . $item['main_image']) }}"
                                         alt="{{ $item['name'] }}"
                                         class="w-full h-full object-cover"
                                         onerror="this.src='https://via.placeholder.com/64x64/0F172A/D4A017?text=PK'"/>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-navy line-clamp-1">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    @if($item['custom_image_path'])
                                        <p class="text-xs" style="color:#B8860B;">📸 Custom photo</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold" style="color:#B8860B;">
                                        ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 pt-4 border-t border-gray-100">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium">₹{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Delivery</span>
                            <span class="font-medium text-green-600">{{ $total >= 999 ? 'FREE' : '₹50.00' }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-100">
                            <span class="text-navy">Grand Total</span>
                            <span style="color:#B8860B;">₹{{ number_format($total >= 999 ? $total : $total + 50, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 text-center leading-relaxed">
                            By placing your order, you agree to our Terms of Service. 
                            Payment is handled securely via WhatsApp.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection