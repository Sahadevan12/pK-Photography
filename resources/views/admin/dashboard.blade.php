{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', '📊 Dashboard')

@section('content')

{{-- ═══════════════════════════════════════
     WELCOME BANNER
═══════════════════════════════════════ --}}
<div class="rounded-2xl p-6 mb-8 text-white relative overflow-hidden"
     style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0"
         style="background: radial-gradient(ellipse at 80% 50%, rgba(212,160,23,0.15) 0%, transparent 60%);"></div>
    <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold mb-1"
                style="font-family: 'Playfair Display', serif;">
                Welcome back, {{ auth()->user()->name ?? 'Admin' }}! 👋
            </h2>
            <p class="text-gray-400 text-sm">
                Here's what's happening with PK Photography today.
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.hero-images.create') }}"
               class="btn-gold text-sm px-5 py-2.5">
                + Add Hero Image
            </a>
            <a href="{{ route('admin.products.create') }}"
               class="btn-outline-gold text-sm px-5 py-2.5"
               style="border-color: rgba(184,134,11,0.6); color: #D4A017;">
                + Add Product
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     STATS CARDS
═══════════════════════════════════════ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Orders --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover"
         style="border: 1px solid #F1F5F9;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                 style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                📦
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                  style="background: #FEF3C7; color: #92400E;">
                Total
            </span>
        </div>
        <p class="text-3xl font-bold mb-1" style="color: #0F172A;">
            {{ $stats['total_orders'] }}
        </p>
        <p class="text-sm text-gray-500">Total Orders</p>
    </div>

    {{-- Pending Orders --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover"
         style="border: 1px solid #F1F5F9;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                 style="background: rgba(239,68,68,0.1);">
                ⏳
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-red-100 text-red-700">
                Pending
            </span>
        </div>
        <p class="text-3xl font-bold mb-1" style="color: #0F172A;">
            {{ $stats['pending_orders'] }}
        </p>
        <p class="text-sm text-gray-500">Pending Orders</p>
    </div>

    {{-- Total Products --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover"
         style="border: 1px solid #F1F5F9;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                 style="background: rgba(59,130,246,0.1);">
                🛍️
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">
                Active
            </span>
        </div>
        <p class="text-3xl font-bold mb-1" style="color: #0F172A;">
            {{ $stats['total_products'] }}
        </p>
        <p class="text-sm text-gray-500">Total Products</p>
    </div>

    {{-- Total Revenue --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover"
         style="border: 1px solid #F1F5F9;">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                 style="background: rgba(16,185,129,0.1);">
                💰
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">
                Revenue
            </span>
        </div>
        <p class="text-3xl font-bold mb-1" style="color: #0F172A;">
            ₹{{ number_format($stats['total_revenue'], 0) }}
        </p>
        <p class="text-sm text-gray-500">Total Revenue</p>
    </div>
</div>

{{-- ═══════════════════════════════════════
     SECOND ROW STATS
═══════════════════════════════════════ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">

    {{-- Categories --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-center gap-4"
         style="border: 1px solid #F1F5F9;">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0"
             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
            🏷️
        </div>
        <div>
            <p class="text-2xl font-bold" style="color: #0F172A;">{{ $stats['total_categories'] }}</p>
            <p class="text-sm text-gray-500">Categories</p>
        </div>
    </div>

    {{-- Hero Images --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-center gap-4"
         style="border: 1px solid #F1F5F9;">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0"
             style="background: rgba(139,92,246,0.1);">
            🖼️
        </div>
        <div>
            <p class="text-2xl font-bold" style="color: #0F172A;">{{ $stats['hero_images'] }}</p>
            <p class="text-sm text-gray-500">Hero Images</p>
        </div>
    </div>

    {{-- Customer Uploads --}}
    <div class="bg-white rounded-2xl p-5 shadow-sm flex items-center gap-4"
         style="border: 1px solid #F1F5F9;">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0"
             style="background: rgba(236,72,153,0.1);">
            📸
        </div>
        <div>
            <p class="text-2xl font-bold" style="color: #0F172A;">{{ $stats['total_uploads'] }}</p>
            <p class="text-sm text-gray-500">Customer Uploads</p>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     RECENT ORDERS + TOP PRODUCTS
═══════════════════════════════════════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Recent Orders --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm overflow-hidden"
         style="border: 1px solid #F1F5F9;">
        <div class="p-6 flex items-center justify-between"
             style="border-bottom: 1px solid #F1F5F9;">
            <h3 class="font-bold text-lg" style="color: #0F172A; font-family: 'Playfair Display', serif;">
                Recent Orders
            </h3>
            <a href="{{ route('admin.orders.index') }}"
               class="text-sm font-medium transition-colors"
               style="color: #B8860B;">
                View All →
            </a>
        </div>

        @if($recentOrders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr style="background: #F8FAFC;">
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Order
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-sm font-semibold" style="color: #0F172A;">
                                        {{ $order->order_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium" style="color: #0F172A;">
                                            {{ $order->customer_name }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            {{ $order->customer_phone }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold" style="color: #B8860B;">
                                        ₹{{ number_format($order->total, 0) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending'    => 'background:#FEF3C7; color:#92400E;',
                                            'confirmed'  => 'background:#DBEAFE; color:#1E40AF;',
                                            'processing' => 'background:#EDE9FE; color:#5B21B6;',
                                            'shipped'    => 'background:#CFFAFE; color:#155E75;',
                                            'delivered'  => 'background:#D1FAE5; color:#065F46;',
                                            'cancelled'  => 'background:#FEE2E2; color:#991B1B;',
                                        ];
                                        $statusStyle = $statusColors[$order->status] ?? 'background:#F3F4F6; color:#374151;';
                                    @endphp
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full capitalize"
                                          style="{{ $statusStyle }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="text-sm font-medium transition-colors"
                                       style="color: #B8860B;">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📦</div>
                <p class="text-gray-500 font-medium">No orders yet</p>
                <p class="text-sm text-gray-400 mt-1">Orders will appear here</p>
            </div>
        @endif
    </div>

    {{-- Top Products + Quick Links --}}
    <div class="flex flex-col gap-6">

        {{-- Top Products --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden"
             style="border: 1px solid #F1F5F9;">
            <div class="p-5" style="border-bottom: 1px solid #F1F5F9;">
                <h3 class="font-bold" style="color: #0F172A; font-family: 'Playfair Display', serif;">
                    🔥 Top Products
                </h3>
            </div>
            <div class="p-4 space-y-3">
                @forelse($topProducts as $index => $product)
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold text-white flex-shrink-0"
                              style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                            {{ $index + 1 }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate" style="color: #0F172A;">
                                {{ $product->name }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $product->order_items_count }} orders
                            </p>
                        </div>
                        <span class="text-sm font-bold flex-shrink-0" style="color: #B8860B;">
                            ₹{{ number_format($product->current_price, 0) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="text-4xl mb-2">🛍️</div>
                        <p class="text-sm text-gray-400">No products yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden"
             style="border: 1px solid #F1F5F9;">
            <div class="p-5" style="border-bottom: 1px solid #F1F5F9;">
                <h3 class="font-bold" style="color: #0F172A; font-family: 'Playfair Display', serif;">
                    ⚡ Quick Actions
                </h3>
            </div>
            <div class="p-4 space-y-2">
                @foreach([
                    ['icon' => '🖼️', 'label' => 'Add Hero Image',    'route' => 'admin.hero-images.create', 'color' => '#7C3AED'],
                    ['icon' => '➕', 'label' => 'Add New Product',    'route' => 'admin.products.create',   'color' => '#2563EB'],
                    ['icon' => '🏷️', 'label' => 'Add Category',       'route' => 'admin.categories.create', 'color' => '#D97706'],
                    ['icon' => '🖼️', 'label' => 'Upload Gallery',     'route' => 'admin.gallery.create',    'color' => '#059669'],
                    ['icon' => '📦', 'label' => 'View All Orders',    'route' => 'admin.orders.index',      'color' => '#DC2626'],
                    ['icon' => '📸', 'label' => 'Customer Uploads',   'route' => 'admin.uploads.index',     'color' => '#DB2777'],
                ] as $action)
                    <a href="{{ route($action['route']) }}"
                       class="flex items-center gap-3 p-3 rounded-xl transition-all duration-200 group"
                       style="hover:background: #F8FAFC;"
                       onmouseover="this.style.background='#F8FAFC'"
                       onmouseout="this.style.background='transparent'">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center text-sm flex-shrink-0"
                              style="background: {{ $action['color'] }}20;">
                            {{ $action['icon'] }}
                        </span>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                            {{ $action['label'] }}
                        </span>
                        <svg class="w-4 h-4 text-gray-300 ml-auto group-hover:text-gray-500 transition-colors"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     BOTTOM INFO ROW
═══════════════════════════════════════ --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

    {{-- Studio Info --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm"
         style="border: 1px solid #F1F5F9;">
        <h3 class="font-bold mb-4" style="color: #0F172A; font-family: 'Playfair Display', serif;">
            📷 Studio Info
        </h3>
        <div class="space-y-3">
            @foreach([
                ['label' => 'Studio Name',  'value' => 'PK Photography'],
                ['label' => 'WhatsApp',     'value' => '+91 9994141294'],
                ['label' => 'Tagline',      'value' => 'Every Picture Tells A Story'],
                ['label' => 'Currency',     'value' => '₹ Indian Rupee'],
            ] as $info)
                <div class="flex items-center justify-between py-2"
                     style="border-bottom: 1px solid #F8FAFC;">
                    <span class="text-sm text-gray-500">{{ $info['label'] }}</span>
                    <span class="text-sm font-medium" style="color: #0F172A;">{{ $info['value'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- WhatsApp Orders CTA --}}
    <div class="rounded-2xl p-6 text-white relative overflow-hidden"
         style="background: linear-gradient(135deg, #0B1120, #0F172A);">
        <div class="absolute inset-0"
             style="background: radial-gradient(ellipse at 80% 20%, rgba(37,211,102,0.1) 0%, transparent 60%);"></div>
        <div class="relative">
            <div class="text-4xl mb-3">💬</div>
            <h3 class="font-bold text-lg mb-2" style="font-family: 'Playfair Display', serif;">
                WhatsApp Orders
            </h3>
            <p class="text-gray-400 text-sm mb-5">
                All customer orders are sent directly to your WhatsApp number for quick processing.
            </p>
            <a href="https://wa.me/919994141294"
               target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-semibold text-sm text-white transition-all duration-300 hover:scale-105"
               style="background: linear-gradient(135deg, #25D366, #128C7E);
                      box-shadow: 0 4px 15px rgba(37,211,102,0.3);">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                </svg>
                Open WhatsApp
            </a>
        </div>
    </div>
</div>

@endsection
