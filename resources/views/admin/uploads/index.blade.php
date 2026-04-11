{{-- resources/views/admin/uploads/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Customer Uploads')
@section('page-title', '📸 Customer Uploads')

@section('content')

<div class="bg-white rounded-2xl shadow-sm overflow-hidden"
     style="border: 1px solid #F1F5F9;">

    @if($uploads->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background:#F8FAFC; border-bottom: 1px solid #F1F5F9;">
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Preview</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploads as $upload)
                        <tr class="hover:bg-gray-50 transition-colors"
                            style="border-bottom: 1px solid #F8FAFC;">
                            <td class="px-6 py-4">
                                <a href="{{ asset('storage/' . $upload->file_path) }}"
                                   target="_blank">
                                    <img src="{{ asset('storage/' . $upload->file_path) }}"
                                         class="w-14 h-14 rounded-xl object-cover shadow-sm hover:opacity-80 transition-opacity"
                                         style="border: 2px solid rgba(184,134,11,0.3);"
                                         onerror="this.src='https://via.placeholder.com/56x56/0F172A/D4A017?text=IMG'"/>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold" style="color:#0F172A;">
                                    {{ $upload->customer_name ?? 'N/A' }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $upload->customer_phone ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($upload->order)
                                    <a href="{{ route('admin.orders.show', $upload->order_id) }}"
                                       class="text-sm font-medium transition-colors"
                                       style="color:#B8860B;">
                                        {{ $upload->order->order_number }}
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400">No order</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600">
                                    {{ $upload->product->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.uploads.status', $upload->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold outline-none cursor-pointer"
                                            style="{{ $upload->status === 'processed'
                                                ? 'background:#D1FAE5; color:#065F46;'
                                                : 'background:#FEF3C7; color:#92400E;' }}">
                                        <option value="pending"   {{ $upload->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                                        <option value="processed" {{ $upload->status === 'processed' ? 'selected' : '' }}>Processed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-gray-400">
                                    {{ $upload->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ asset('storage/' . $upload->file_path) }}"
                                       download
                                       class="px-3 py-1.5 rounded-lg text-xs font-medium"
                                       style="background:#EFF6FF; color:#2563EB;">
                                        ⬇️ Download
                                    </a>
                                    <form action="{{ route('admin.uploads.destroy', $upload->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this upload?')">
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
            {{ $uploads->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-7xl mb-4">📸</div>
            <h3 class="text-xl font-bold mb-2" style="color:#0F172A; font-family:'Playfair Display',serif;">
                No Customer Uploads Yet
            </h3>
            <p class="text-gray-400 text-sm">
                Customer photo uploads will appear here when orders are placed
            </p>
        </div>
    @endif
</div>

@endsection