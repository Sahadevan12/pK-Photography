{{-- resources/views/admin/orders/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Orders')
@section('page-title', '📦 Orders')

@section('content')

{{-- Filter --}}
<form method="GET" action="{{ route('admin.orders.index') }}"
      class="flex flex-col md:flex-row gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}"
           class="flex-1 px-4 py-2.5 rounded-xl text-sm outline-none"
           style="border: 2px solid #E5E7EB; color:#0F172A;"
           onfocus="this.style.borderColor='#B8860B'"
           onblur="this.style.borderColor='#E5E7EB'"
           placeholder="🔍 Search by order no, name, phone..."/>
    <select name="status"
            class="px-4 py-2.5 rounded-xl text-sm outline-none bg-white"
            style="border: 2px solid #E5E7EB; color:#0F172A;">
        <option value="">All Status</option>
        @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                {{ ucfirst($s) }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn-gold px-6">Filter</button>
</form>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden"
     style="border: 1px solid #F1F5F9;">

    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background:#F8FAFC; border-bottom: 1px solid #F1F5F9;">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Order #</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Items</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @php
                            $statusColors = [
                                'pending'    => 'background:#FEF3C7; color:#92400E;',
                                'confirmed'  => 'background:#DBEAFE; color:#1E40AF;',
                                'processing' => 'background:#EDE9FE; color:#5B21B6;',
                                'shipped'    => 'background:#CFFAFE; color:#155E75;',
                                'delivered'  => 'background:#D1FAE5; color:#065F46;',
                                'cancelled'  => 'background:#FEE2E2; color:#991B1B;',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors"
                            style="border-bottom: 1px solid #F8FAFC;">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold" style="color:#0F172A;">
                                    {{ $order->order_number }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold" style="color:#0F172A;">
                                    {{ $order->customer_name }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $order->customer_phone }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">
                                    {{ $order->items->count() }} item(s)
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold" style="color:#B8860B;">
                                    ₹{{ number_format($order->total, 0) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full capitalize"
                                      style="{{ $statusColors[$order->status] ?? 'background:#F3F4F6; color:#374151;' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-gray-400">
                                    {{ $order->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="px-3 py-1.5 rounded-lg text-xs font-medium"
                                       style="background:#EFF6FF; color:#2563EB;">
                                        👁️ View
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this order?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg text-xs font-medium"
                                                style="background:#FEE2E2; color:#991B1B;">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4" style="border-top: 1px solid #F1F5F9;">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-4">📦</div>
            <h3 class="text-xl font-bold mb-2" style="color:#0F172A; font-family:'Playfair Display',serif;">
                No Orders Yet
            </h3>
            <p class="text-gray-400 text-sm">Orders from customers will appear here</p>
        </div>
    @endif
</div>

@endsection