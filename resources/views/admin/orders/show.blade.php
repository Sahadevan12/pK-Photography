{{-- resources/views/admin/orders/show.blade.php --}}
@extends('layouts.admin')
@section('title', 'Order Details')
@section('page-title', '📋 Order Details')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Order Header --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm"
         style="border: 1px solid #F1F5F9;">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold" style="color:#0F172A; font-family:'Playfair Display',serif;">
                    {{ $order->order_number }}
                </h2>
                <p class="text-sm text-gray-400 mt-1">
                    Placed on {{ $order->created_at->format('d M Y, h:i A') }}
                </p>
            </div>

            {{-- Status Update --}}
            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST"
                  class="flex items-center gap-3">
                @csrf
                @method('PATCH')
                <select name="status"
                        class="px-4 py-2.5 rounded-xl text-sm outline-none bg-white"
                        style="border: 2px solid #E5E7EB; color:#0F172A;"
                        onfocus="this.style.borderColor='#B8860B'"
                        onblur="this.style.borderColor='#E5E7EB'">
                    @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-gold px-5 py-2.5 text-sm">
                    Update
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Customer Info --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm" style="border: 1px solid #F1F5F9;">
            <h3 class="font-bold mb-4" style="color:#0F172A; font-family:'Playfair Display',serif;">
                👤 Customer Details
            </h3>
            <div class="space-y-3">
                @foreach([
                    ['label' => 'Name',    'value' => $order->customer_name],
                    ['label' => 'Phone',   'value' => $order->customer_phone],
                    ['label' => 'Email',   'value' => $order->customer_email ?? 'N/A'],
                    ['label' => 'City',    'value' => $order->city],
                    ['label' => 'Pincode', 'value' => $order->pincode],
                ] as $info)
                    <div class="flex justify-between text-sm py-2"
                         style="border-bottom: 1px solid #F8FAFC;">
                        <span class="text-gray-500">{{ $info['label'] }}</span>
                        <span class="font-medium" style="color:#0F172A;">{{ $info['value'] }}</span>
                    </div>
                @endforeach
                <div class="text-sm py-2">
                    <span class="text-gray-500 block mb-1">Address</span>
                    <span class="font-medium" style="color:#0F172A;">{{ $order->customer_address }}</span>
                </div>
            </div>

            {{-- WhatsApp Button --}}
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}"
               target="_blank"
               class="mt-4 flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:opacity-90"
               style="background: linear-gradient(135deg, #25D366, #128C7E);">
                💬 WhatsApp Customer
            </a>
        </div>

        {{-- Order Summary --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm" style="border: 1px solid #F1F5F9;">
            <h3 class="font-bold mb-4" style="color:#0F172A; font-family:'Playfair Display',serif;">
                💰 Order Summary
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between py-2" style="border-bottom: 1px solid #F8FAFC;">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-medium">₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between py-2" style="border-bottom: 1px solid #F8FAFC;">
                    <span class="text-gray-500">Discount</span>
                    <span class="font-medium text-green-600">-₹{{ number_format($order->discount, 2) }}</span>
                </div>
                <div class="flex justify-between py-3 font-bold text-base">
                    <span style="color:#0F172A;">Total</span>
                    <span style="color:#B8860B;">₹{{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            @if($order->notes)
                <div class="mt-4 p-3 rounded-xl text-sm"
                     style="background:#F8FAFC; color:#64748B;">
                    <p class="font-semibold mb-1" style="color:#0F172A;">📝 Notes:</p>
                    {{ $order->notes }}
                </div>
            @endif
        </div>
    </div>

    {{-- Order Items --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" style="border: 1px solid #F1F5F9;">
        <div class="p-6" style="border-bottom: 1px solid #F1F5F9;">
            <h3 class="font-bold" style="color:#0F172A; font-family:'Playfair Display',serif;">
                🛍️ Order Items
            </h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($order->items as $item)
                <div class="p-6 flex items-center gap-5">
                    @if($item->product)
                        <img src="{{ asset('storage/' . $item->product->main_image) }}"
                             class="w-16 h-16 rounded-xl object-cover shadow-sm flex-shrink-0"/>
                    @endif
                    <div class="flex-1">
                        <p class="font-semibold text-sm" style="color:#0F172A;">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            ₹{{ number_format($item->price, 2) }} × {{ $item->quantity }}
                        </p>
                        @if($item->custom_image_path)
                            <div class="mt-2 flex items-center gap-2">
                                <img src="{{ asset('storage/' . $item->custom_image_path) }}"
                                     class="w-10 h-10 rounded-lg object-cover"
                                     style="border: 2px solid #B8860B;"/>
                                <span class="text-xs" style="color:#B8860B;">📸 Custom photo uploaded</span>
                            </div>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="font-bold" style="color:#B8860B;">
                            ₹{{ number_format($item->total, 2) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.orders.index') }}" class="btn-outline-gold">
            ← Back to Orders
        </a>
    </div>
</div>

@endsection