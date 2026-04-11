{{-- resources/views/shop/cart.blade.php --}}
@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')

<div class="py-16 bg-brand-bg min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-10">
            <h1 class="text-4xl font-serif font-bold text-navy">Shopping Cart</h1>
            @if(!empty($cart))
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium transition-colors">
                        🗑️ Clear Cart
                    </button>
                </form>
            @endif
        </div>

        @if(!empty($cart))
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-5">
                    @foreach($cart as $rowId => $item)
                        <div class="bg-white rounded-2xl p-6 shadow-sm flex flex-col sm:flex-row gap-5 items-start sm:items-center">

                            {{-- Product Image --}}
                            <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 shadow-md">
                                <img src="{{ asset('storage/' . $item['main_image']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.src='https://via.placeholder.com/100x100/0F172A/D4A017?text=PK'"/>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1">
                                <h3 class="font-semibold text-navy mb-1">{{ $item['name'] }}</h3>
                                <p class="text-sm font-bold mb-2" style="color:#B8860B;">₹{{ number_format($item['price'], 2) }} each</p>

                                @if($item['custom_image_path'])
                                    <div class="flex items-center gap-2 mb-2">
                                        <img src="{{ asset('storage/' . $item['custom_image_path']) }}"
                                             class="w-10 h-10 rounded-lg object-cover border-2"
                                             style="border-color: #B8860B;"/>
                                        <span class="text-xs text-gray-500">📸 Custom photo uploaded</span>
                                    </div>
                                @endif

                                {{-- Quantity Update --}}
                                <form action="{{ route('cart.update', $rowId) }}" method="POST"
                                      class="flex items-center gap-3 mt-2">
                                    @csrf
                                    @method('PATCH')
                                    <label class="text-xs text-gray-500">Qty:</label>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                           min="1" max="10"
                                           class="w-16 text-center py-1.5 rounded-lg border-2 border-gray-200 text-sm focus:outline-none"
                                           onfocus="this.style.borderColor='#B8860B'"
                                           onblur="this.style.borderColor=''"/>
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg font-medium text-white transition-all hover:opacity-90"
                                            style="background: linear-gradient(135deg, #0B1120, #1E293B);">
                                        Update
                                    </button>
                                </form>
                            </div>

                            {{-- Subtotal + Remove --}}
                            <div class="text-right flex-shrink-0">
                                <p class="text-lg font-bold mb-3" style="color:#B8860B;">
                                    ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                                <form action="{{ route('cart.remove', $rowId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 transition-colors font-medium">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-8 shadow-sm sticky top-28">
                        <h2 class="text-xl font-serif font-bold text-navy mb-6">Order Summary</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal ({{ collect($cart)->sum('quantity') }} items)</span>
                                <span class="font-medium text-navy">₹{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Delivery</span>
                                <span class="font-medium text-green-600">{{ $total >= 999 ? 'FREE' : '₹50.00' }}</span>
                            </div>
                            <div class="h-px" style="background: rgba(184,134,11,0.2);"></div>
                            <div class="flex justify-between font-bold text-lg">
                                <span class="text-navy">Total</span>
                                <span style="color:#B8860B;">₹{{ number_format($total >= 999 ? $total : $total + 50, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn-gold w-full justify-center py-4 mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('shop.index') }}" class="block text-center text-sm text-gray-500 hover:text-gold transition-colors">
                            ← Continue Shopping
                        </a>

                        {{-- Free shipping notice --}}
                        @if($total < 999)
                            <div class="mt-5 p-3 rounded-xl text-center text-xs"
                                 style="background: rgba(184,134,11,0.08); color:#7B5A00; border: 1px solid rgba(184,134,11,0.2);">
                                Add ₹{{ number_format(999 - $total, 0) }} more for FREE delivery!
                            </div>
                        @else
                            <div class="mt-5 p-3 rounded-xl text-center text-xs bg-green-50 text-green-700 border border-green-200">
                                🎉 You qualify for FREE delivery!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            {{-- Empty Cart --}}
            <div class="text-center py-24">
                <div class="text-9xl mb-8">🛒</div>
                <h2 class="text-3xl font-serif font-bold text-navy mb-4">Your Cart is Empty</h2>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">
                    Looks like you haven't added any products yet. Explore our beautiful photo products!
                </p>
                <a href="{{ route('shop.index') }}" class="btn-gold px-10 py-4">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>

@endsection