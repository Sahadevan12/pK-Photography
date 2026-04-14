{{-- resources/views/shop/track-result.blade.php --}}
@extends('layouts.app')
@section('title', 'Order Status')

@section('content')
<div style="padding:3rem 1rem; background:#F8FAFC; min-height:80vh;">
    <div style="max-width:700px; margin:0 auto;">

        {{-- Header --}}
        <div style="text-align:center; margin-bottom:2rem;">
            <h1 style="font-family:'Playfair Display',serif; font-size:2rem; font-weight:700; color:#0F172A;">
                Order Status
            </h1>
        </div>

        {{-- Order ID + Status --}}
        <div style="background:white; border-radius:1.5rem; padding:1.5rem; margin-bottom:1.5rem;
                    box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #F1F5F9;">
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
                <div>
                    <p style="font-size:0.75rem; color:#9CA3AF; margin-bottom:0.25rem; text-transform:uppercase; letter-spacing:0.1em;">
                        Order ID
                    </p>
                    <p style="font-size:1.25rem; font-weight:800; color:#B8860B; letter-spacing:0.05em;">
                        {{ $order->order_number }}
                    </p>
                    <p style="font-size:0.75rem; color:#9CA3AF; margin-top:0.25rem;">
                        Placed on {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>

                {{-- Status Badge --}}
                @php
                    $statusConfig = [
                        'pending'    => ['bg'=>'#FEF3C7', 'color'=>'#92400E', 'icon'=>'⏳', 'label'=>'Pending'],
                        'confirmed'  => ['bg'=>'#DBEAFE', 'color'=>'#1E40AF', 'icon'=>'✅', 'label'=>'Confirmed'],
                        'processing' => ['bg'=>'#EDE9FE', 'color'=>'#5B21B6', 'icon'=>'⚙️', 'label'=>'Processing'],
                        'shipped'    => ['bg'=>'#CFFAFE', 'color'=>'#155E75', 'icon'=>'🚚', 'label'=>'Shipped'],
                        'delivered'  => ['bg'=>'#D1FAE5', 'color'=>'#065F46', 'icon'=>'🎉', 'label'=>'Delivered'],
                        'cancelled'  => ['bg'=>'#FEE2E2', 'color'=>'#991B1B', 'icon'=>'❌', 'label'=>'Cancelled'],
                    ];
                    $sc = $statusConfig[$order->status] ?? ['bg'=>'#F3F4F6','color'=>'#374151','icon'=>'📦','label'=>ucfirst($order->status)];
                @endphp
                <div style="padding:0.75rem 1.5rem; border-radius:9999px; font-weight:700; font-size:1rem;
                             background:{{ $sc['bg'] }}; color:{{ $sc['color'] }};">
                    {{ $sc['icon'] }} {{ $sc['label'] }}
                </div>
            </div>
        </div>

        {{-- ✅ STATUS PROGRESS BAR --}}
        @php
            $steps = ['pending','confirmed','processing','shipped','delivered'];
            $currentIndex = array_search($order->status, $steps);
            if ($currentIndex === false) $currentIndex = -1;
        @endphp
        @if($order->status !== 'cancelled')
            <div style="background:white; border-radius:1.5rem; padding:1.5rem; margin-bottom:1.5rem;
                        box-shadow:0 2px 8px rgba(0,0,0,0.05); border:1px solid #F1F5F9;">
                <p style="font-weight:700; color:#0F172A; margin-bottom:1.25rem; font-size:0.875rem;">
                    📍 Order Progress
                </p>
                <div style="display:flex; align-items:center; justify-content:space-between; position:relative;">
                    {{-- Progress Line --}}
                    <div style="position:absolute; top:1.25rem; left:1.5rem; right:1.5rem; height:3px;
                                background:#E5E7EB; border-radius:9999px; z-index:0;"></div>
                    <div style="position:absolute; top:1.25rem; left:1.5rem; height:3px;
                                background:linear-gradient(90deg,#7B5A00,#D4A017);
                                border-radius:9999px; z-index:1;
                                width:{{ $currentIndex >= 0 ? ($currentIndex / (count($steps)-1)) * 100 : 0 }}%;
                                transition:width 0.5s ease;">
                    </div>

                    @foreach($steps as $i => $step)
                        @php
                            $stepConfig = [
                                'pending'    => ['icon'=>'📋','label'=>'Pending'],
                                'confirmed'  => ['icon'=>'✅','label'=>'Confirmed'],
                                'processing' => ['icon'=>'⚙️','label'=>'Processing'],
                                'shipped'    => ['icon'=>'🚚','label'=>'Shipped'],
                                'delivered'  => ['icon'=>'🎉','label'=>'Delivered'],
                            ];
                            $sc2       = $stepConfig[$step];
                            $isDone    = $i <= $currentIndex;
                            $isCurrent = $i === $currentIndex;
                        @endphp
                        <div style="display:flex; flex-direction:column; align-items:center; position:relative; z-index:2; flex:1;">
                            <div style="width:2.5rem; height:2.5rem; border-radius:50%; border:3px solid;
                                        display:flex; align-items:center; justify-content:center; font-size:1rem;
                                        background:{{ $isDone ? 'linear-gradient(135deg,#7B5A00,#D4A017)' : 'white' }};
                                        border-color:{{ $isDone ? '#B8860B' : '#E5E7EB' }};
                                        {{ $isCurrent ? 'box-shadow:0 0 0 4px rgba(184,134,11,0.2);' : '' }}
                                        transition:all 0.3s;">
                                {{ $isDone ? $sc2['icon'] : '' }}
                            </div>
                            <p style="font-size:0.65rem; font-weight:{{ $isCurrent ? '700' : '500' }};
                                       color:{{ $isDone ? '#B8860B' : '#9CA3AF' }}; margin-top:0.4rem;
                                       text-align:center;">
                                {{ $sc2['label'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Order Items --}}
        <div style="background:white; border-radius:1.5rem; padding:1.5rem; margin-bottom:1.5rem;
                    box-shadow:0 2px 8px rgba(0,0,0,0.05); border:1px solid #F1F5F9;">
            <p style="font-weight:700; color:#0F172A; margin-bottom:1rem; font-size:0.875rem;">
                🛍️ Items Ordered
            </p>

            @foreach($order->items as $item)
                <div style="display:flex; gap:1rem; padding:1rem 0; border-bottom:1px solid #F8FAFC;
                             align-items:center;">
                    {{-- Product Image --}}
                    <div style="position:relative; width:5rem; height:5rem; flex-shrink:0; border-radius:0.75rem; overflow:hidden;">
                        @if($item->custom_image_path)
                            {{-- User uploaded image behind frame --}}
                            <img src="{{ asset('storage/' . $item->custom_image_path) }}"
                                 style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:1;"/>
                        @endif
                        @if($item->product)
                            <img src="{{ asset('storage/' . $item->product->main_image) }}"
                                 style="position:absolute; inset:0; width:100%; height:100%;
                                        object-fit:contain; z-index:2; pointer-events:none;"/>
                        @endif
                    </div>

                    <div style="flex:1;">
                        <p style="font-weight:600; color:#0F172A; font-size:0.875rem; margin-bottom:0.25rem;">
                            {{ $item->product_name }}
                        </p>
                        <p style="font-size:0.75rem; color:#9CA3AF;">
                            ₹{{ number_format($item->price, 0) }} × {{ $item->quantity }}
                        </p>
                        @if($item->custom_image_path)
                            <span style="font-size:0.7rem; color:#B8860B; font-weight:600;">
                                📸 Custom photo included
                            </span>
                        @endif
                    </div>

                    <span style="font-weight:700; color:#B8860B; font-size:0.875rem;">
                        ₹{{ number_format($item->total, 0) }}
                    </span>
                </div>
            @endforeach

            {{-- Total --}}
            <div style="display:flex; justify-content:space-between; padding-top:1rem;
                         font-weight:800; font-size:1.125rem;">
                <span style="color:#0F172A;">Total Paid</span>
                <span style="color:#B8860B;">₹{{ number_format($order->total, 0) }}</span>
            </div>
        </div>

        {{-- Delivery Address --}}
        <div style="background:white; border-radius:1.5rem; padding:1.5rem; margin-bottom:1.5rem;
                    box-shadow:0 2px 8px rgba(0,0,0,0.05); border:1px solid #F1F5F9;">
            <p style="font-weight:700; color:#0F172A; margin-bottom:0.75rem; font-size:0.875rem;">
                📍 Delivery Address
            </p>
            <p style="font-size:0.875rem; color:#4B5563; line-height:1.75;">
                <strong>{{ $order->customer_name }}</strong><br>
                {{ $order->customer_address }},<br>
                {{ $order->city }} — {{ $order->pincode }}<br>
                📞 {{ $order->customer_phone }}
            </p>
        </div>

        {{-- Actions --}}
        <div style="display:flex; gap:1rem; flex-wrap:wrap;">
            <a href="https://wa.me/919994141294?text=Hi! I want to enquire about my order: {{ $order->order_number }}"
               target="_blank"
               style="flex:1; display:flex; align-items:center; justify-content:center; gap:0.5rem;
                      padding:0.875rem; border-radius:9999px; font-weight:600; font-size:0.875rem;
                      text-decoration:none; color:white; min-width:180px;
                      background:linear-gradient(135deg,#25D366,#128C7E);
                      box-shadow:0 4px 15px rgba(37,211,102,0.3);">
                💬 WhatsApp Support
            </a>
            <a href="{{ route('order.track') }}"
               style="flex:1; display:flex; align-items:center; justify-content:center; gap:0.5rem;
                      padding:0.875rem; border-radius:9999px; font-weight:600; font-size:0.875rem;
                      text-decoration:none; color:#B8860B; border:2px solid #B8860B; min-width:180px;
                      transition:all 0.2s;"
               onmouseover="this.style.background='rgba(184,134,11,0.08)'"
               onmouseout="this.style.background='transparent'">
                🔍 Track Another Order
            </a>
        </div>
    </div>
</div>
@endsection