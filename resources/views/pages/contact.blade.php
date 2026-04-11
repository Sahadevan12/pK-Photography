{{-- resources/views/pages/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Contact')

@section('content')

{{-- Hero --}}
<section class="relative py-32 overflow-hidden"
         style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0"
         style="background: radial-gradient(ellipse at 60% 50%, rgba(212,160,23,0.1) 0%, transparent 60%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-3"
           style="color:#D4A017;">Get In Touch</p>
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6"
            style="font-family:'Playfair Display',serif;">
            Contact Us
        </h1>
        <div style="width:6rem; height:4px; margin:1rem auto;
                    background:linear-gradient(90deg,#7B5A00,#D4A017,#B8860B);
                    border-radius:9999px;"></div>
        <p class="text-lg text-gray-300 max-w-xl mx-auto">
            Ready to capture your story? We'd love to hear from you.
        </p>
    </div>
</section>

{{-- Contact Content --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            {{-- ── Contact Form ── --}}
            <div>
                <h2 class="text-3xl font-bold mb-8" style="color:#0F172A; font-family:'Playfair Display',serif;">
                    Send Us a Message
                </h2>

                @if(session('success'))
                    <div class="mb-6 px-5 py-4 rounded-2xl text-sm font-medium"
                         style="background: #f0fdf4; border: 1px solid #86efac; color: #166534;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                                Full Name *
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                                   style="border: 2px solid #E5E7EB; color:#0F172A;"
                                   onfocus="this.style.borderColor='#B8860B'"
                                   onblur="this.style.borderColor='#E5E7EB'"
                                   placeholder="Your full name"/>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                                Phone Number *
                            </label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                                   style="border: 2px solid #E5E7EB; color:#0F172A;"
                                   onfocus="this.style.borderColor='#B8860B'"
                                   onblur="this.style.borderColor='#E5E7EB'"
                                   placeholder="+91 XXXXX XXXXX"/>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                            Email Address *
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all"
                               style="border: 2px solid #E5E7EB; color:#0F172A;"
                               onfocus="this.style.borderColor='#B8860B'"
                               onblur="this.style.borderColor='#E5E7EB'"
                               placeholder="your@email.com"/>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                            Service Interested In
                        </label>
                        <select name="service"
                                class="w-full px-4 py-3 rounded-xl text-sm outline-none bg-white transition-all"
                                style="border: 2px solid #E5E7EB; color:#0F172A;"
                                onfocus="this.style.borderColor='#B8860B'"
                                onblur="this.style.borderColor='#E5E7EB'">
                            <option value="">Select a service...</option>
                            @foreach([
                                'Wedding Photography',
                                'Pre-Wedding Shoot',
                                'Portrait Session',
                                'Event Coverage',
                                'Videography',
                                'Photo Products / Gifts',
                            ] as $service)
                                <option>{{ $service }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color:#0F172A;">
                            Message *
                        </label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all resize-none"
                                  style="border: 2px solid #E5E7EB; color:#0F172A;"
                                  onfocus="this.style.borderColor='#B8860B'"
                                  onblur="this.style.borderColor='#E5E7EB'"
                                  placeholder="Tell us about your event date, location, and any special requirements...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="btn-gold w-full justify-center py-4 text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Send Message
                    </button>
                </form>
            </div>

            {{-- ── Contact Info ── --}}
            <div>
                <h2 class="text-3xl font-bold mb-8"
                    style="color:#0F172A; font-family:'Playfair Display',serif;">
                    Find Us
                </h2>

                <div class="space-y-4 mb-8">

                    {{-- Address --}}
                    <div class="flex items-start gap-4 p-5 rounded-2xl"
                         style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7);
                                border: 1px solid rgba(184,134,11,0.15);">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                            📍
                        </div>
                        <div>
                            <h4 class="font-semibold mb-1" style="color:#0F172A;">Studio Address</h4>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                8/37, Sree Mahavishnu Complex,<br>
                                Govindapuram, Palakkad,<br>
                                Kerala — 678507
                            </p>
                            <a href="https://maps.google.com/?q=Govindapuram+Palakkad+Kerala+678507"
                               target="_blank"
                               class="inline-flex items-center gap-1 text-xs font-medium mt-2 transition-colors"
                               style="color:#B8860B; text-decoration:none;"
                               onmouseover="this.style.color='#D4A017'"
                               onmouseout="this.style.color='#B8860B'">
                                📌 View on Maps →
                            </a>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="flex items-start gap-4 p-5 rounded-2xl"
                         style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7);
                                border: 1px solid rgba(184,134,11,0.15);">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                            📞
                        </div>
                        <div>
                            <h4 class="font-semibold mb-1" style="color:#0F172A;">Phone & WhatsApp</h4>
                            <a href="tel:+919994141294"
                               class="text-sm text-gray-600 hover:text-gold transition-colors block"
                               style="text-decoration:none;"
                               onmouseover="this.style.color='#B8860B'"
                               onmouseout="this.style.color=''">
                                +91 99941 41294
                            </a>
                            <a href="https://wa.me/919994141294"
                               target="_blank"
                               class="inline-flex items-center gap-1 text-xs font-medium mt-1"
                               style="color:#25D366; text-decoration:none;">
                                💬 Chat on WhatsApp
                            </a>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-start gap-4 p-5 rounded-2xl"
                         style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7);
                                border: 1px solid rgba(184,134,11,0.15);">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                            📧
                        </div>
                        <div>
                            <h4 class="font-semibold mb-1" style="color:#0F172A;">Email Address</h4>
                            <a href="mailto:pkphotography41@gmail.com"
                               class="text-sm text-gray-600 transition-colors"
                               style="text-decoration:none;"
                               onmouseover="this.style.color='#B8860B'"
                               onmouseout="this.style.color=''">
                                pkphotography41@gmail.com
                            </a>
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="flex items-start gap-4 p-5 rounded-2xl"
                         style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7);
                                border: 1px solid rgba(184,134,11,0.15);">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                            📸
                        </div>
                        <div>
                            <h4 class="font-semibold mb-1" style="color:#0F172A;">Instagram</h4>
                            <a href="https://www.instagram.com/pk_photography_41"
                               target="_blank"
                               class="text-sm text-gray-600 transition-colors"
                               style="text-decoration:none;"
                               onmouseover="this.style.color='#B8860B'"
                               onmouseout="this.style.color=''">
                                @pk_photography_41
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">Follow us for latest work</p>
                        </div>
                    </div>

                    {{-- Working Hours --}}
                    <div class="flex items-start gap-4 p-5 rounded-2xl"
                         style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7);
                                border: 1px solid rgba(184,134,11,0.15);">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                            ⏰
                        </div>
                        <div>
                            <h4 class="font-semibold mb-1" style="color:#0F172A;">Working Hours</h4>
                            <p class="text-sm text-gray-600">Mon – Sat: 9:00 AM – 8:00 PM</p>
                            <p class="text-sm text-gray-600">Sunday: By Appointment Only</p>
                        </div>
                    </div>
                </div>

                {{-- WhatsApp CTA Card --}}
                <div class="p-6 rounded-2xl text-center"
                     style="background: linear-gradient(135deg, #0B1120, #0F172A);">
                    <p class="text-white font-bold text-lg mb-1"
                       style="font-family:'Playfair Display',serif;">
                        Quick Response?
                    </p>
                    <p class="text-gray-400 text-sm mb-5">
                        Message us on WhatsApp for instant replies!
                    </p>
                    <a href="https://wa.me/919994141294?text=Hello%20PK%20Photography!%20I%20am%20interested%20in%20your%20services."
                       target="_blank"
                       class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full font-semibold text-white text-sm transition-all duration-300 hover:scale-105"
                       style="background: linear-gradient(135deg, #25D366, #128C7E);
                              box-shadow: 0 4px 20px rgba(37,211,102,0.3);
                              text-decoration:none;">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                        </svg>
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection