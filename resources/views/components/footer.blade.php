{{-- resources/views/components/footer.blade.php --}}
<footer style="background-color: #0F172A;" class="text-gray-300">

    {{-- Gold top border --}}
    <div class="h-1 w-full"
         style="background: linear-gradient(90deg, #7B5A00, #D4A017, #B8860B, #D4A017, #7B5A00);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- ── Brand Column ── --}}
            <div class="lg:col-span-1">
                {{-- Logo --}}
                <div class="mb-6">
                    <svg viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"
                         style="width:160px; height:80px;" fill="none">
                        <defs>
                            <linearGradient id="fg1" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%"   stop-color="#7B5A00"/>
                                <stop offset="50%"  stop-color="#D4A017"/>
                                <stop offset="100%" stop-color="#B8860B"/>
                            </linearGradient>
                            <linearGradient id="fg2" x1="100%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%"   stop-color="#D4A017"/>
                                <stop offset="100%" stop-color="#7B5A00"/>
                            </linearGradient>
                        </defs>
                        <circle cx="80" cy="38" r="34" fill="none" stroke="url(#fg1)" stroke-width="1" opacity="0.4"/>
                        <text x="48" y="58" font-family="Playfair Display, Georgia, serif"
                              font-size="52" font-weight="700" font-style="italic"
                              fill="url(#fg1)">p</text>
                        <text x="78" y="55" font-family="Playfair Display, Georgia, serif"
                              font-size="48" font-weight="800"
                              fill="url(#fg2)">K</text>
                        <line x1="20" y1="68" x2="160" y2="68" stroke="url(#fg1)" stroke-width="1.2" opacity="0.7"/>
                        <text x="90" y="82" font-family="Playfair Display, Georgia, serif"
                              font-size="10" font-weight="600" letter-spacing="5"
                              fill="url(#fg1)" text-anchor="middle">PHOTOGRAPHY</text>
                        <text x="90" y="95" font-family="Georgia, serif"
                              font-size="5.5" letter-spacing="2"
                              fill="#B8860B" text-anchor="middle" opacity="0.85">
                            EVERY PICTURE TELLS A STORY
                        </text>
                    </svg>
                </div>

                <p class="text-sm text-gray-400 leading-relaxed mb-6">
                    Capturing the love, joy, and magic of your most precious moments.
                    Professional photography that tells your unique story.
                </p>

                {{-- Social Links --}}
                <div class="flex gap-3">

                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/pk_photography_41"
                       target="_blank"
                       class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
                       style="background: rgba(184,134,11,0.15); border: 1px solid rgba(184,134,11,0.3);"
                       onmouseover="this.style.background='linear-gradient(135deg,#833ab4,#fd1d1d,#fcb045)'; this.style.border='none';"
                       onmouseout="this.style.background='rgba(184,134,11,0.15)'; this.style.border='1px solid rgba(184,134,11,0.3)';"
                       title="Instagram: @pk_photography_41">
                        <svg class="w-4 h-4 fill-current" style="color:#D4A017;" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>

                    {{-- WhatsApp --}}
                    <a href="https://wa.me/919994141294"
                       target="_blank"
                       class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
                       style="background: rgba(184,134,11,0.15); border: 1px solid rgba(184,134,11,0.3);"
                       onmouseover="this.style.background='linear-gradient(135deg,#25D366,#128C7E)'; this.style.border='none';"
                       onmouseout="this.style.background='rgba(184,134,11,0.15)'; this.style.border='1px solid rgba(184,134,11,0.3)';"
                       title="WhatsApp">
                        <svg class="w-4 h-4 fill-current" style="color:#D4A017;" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                        </svg>
                    </a>

                    {{-- Gmail --}}
                    <a href="mailto:pkphotography41@gmail.com"
                       class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
                       style="background: rgba(184,134,11,0.15); border: 1px solid rgba(184,134,11,0.3);"
                       onmouseover="this.style.background='linear-gradient(135deg,#EA4335,#FBBC05)'; this.style.border='none';"
                       onmouseout="this.style.background='rgba(184,134,11,0.15)'; this.style.border='1px solid rgba(184,134,11,0.3)';"
                       title="Email Us">
                        <svg class="w-4 h-4 fill-current" style="color:#D4A017;" viewBox="0 0 24 24">
                            <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 010 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.910 1.528-1.145C21.69 2.28 24 3.434 24 5.457z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ── Quick Links ── --}}
            <div>
                <h4 class="font-semibold mb-6 text-sm tracking-widest uppercase"
                    style="color: #D4A017;">Quick Links</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['name' => 'Home',        'route' => 'home'],
                        ['name' => 'About Us',    'route' => 'about'],
                        ['name' => 'Services',    'route' => 'services'],
                        ['name' => 'Pre-Wedding', 'route' => 'pre-wedding'],
                        ['name' => 'Gallery',     'route' => 'gallery'],
                        ['name' => 'Shop',        'route' => 'shop.index'],
                        ['name' => 'Contact',     'route' => 'contact'],
                    ] as $link)
                        <li>
                            <a href="{{ route($link['route']) }}"
                               class="text-gray-400 text-sm flex items-center gap-2 group transition-colors duration-200"
                               style="text-decoration:none;"
                               onmouseover="this.style.color='#D4A017'"
                               onmouseout="this.style.color=''">
                                <span class="w-1.5 h-1.5 rounded-full flex-shrink-0"
                                      style="background:#B8860B;"></span>
                                {{ $link['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── Shop Categories ── --}}
            <div>
                <h4 class="font-semibold mb-6 text-sm tracking-widest uppercase"
                    style="color: #D4A017;">Shop</h4>
                <ul class="space-y-3">
                    @foreach([
                        'Tea Cups',
                        'Photo Frames',
                        'Coffee Mug Frames',
                        'Gifts',
                        'All Products',
                    ] as $item)
                        <li>
                            <a href="{{ route('shop.index') }}"
                               class="text-gray-400 text-sm flex items-center gap-2 transition-colors duration-200"
                               style="text-decoration:none;"
                               onmouseover="this.style.color='#D4A017'"
                               onmouseout="this.style.color=''">
                                <span class="w-1.5 h-1.5 rounded-full flex-shrink-0"
                                      style="background:#B8860B;"></span>
                                {{ $item }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── Contact Info ── --}}
            <div>
                <h4 class="font-semibold mb-6 text-sm tracking-widest uppercase"
                    style="color: #D4A017;">Contact Us</h4>

                <ul class="space-y-4">

                    {{-- Address --}}
                    <li class="flex items-start gap-3 text-sm text-gray-400">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color:#B8860B;"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="leading-relaxed">
                            8/37, Sree Mahavishnu Complex,<br>
                            Govindapuram, Palakkad<br>
                            Kerala - 678507
                        </span>
                    </li>

                    {{-- Phone --}}
                    <li class="flex items-center gap-3 text-sm text-gray-400">
                        <svg class="w-5 h-5 flex-shrink-0" style="color:#B8860B;"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+919994141294"
                           style="color:inherit; text-decoration:none;"
                           onmouseover="this.style.color='#D4A017'"
                           onmouseout="this.style.color=''">
                            +91 9994141294
                        </a>
                    </li>

                    {{-- Email --}}
                    <li class="flex items-center gap-3 text-sm text-gray-400">
                        <svg class="w-5 h-5 flex-shrink-0" style="color:#B8860B;"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:pkphotography41@gmail.com"
                           style="color:inherit; text-decoration:none;"
                           onmouseover="this.style.color='#D4A017'"
                           onmouseout="this.style.color=''">
                            pkphotography41@gmail.com
                        </a>
                    </li>

                    {{-- Instagram --}}
                    <li class="flex items-center gap-3 text-sm text-gray-400">
                        <svg class="w-5 h-5 flex-shrink-0 fill-current" style="color:#B8860B;" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                        <a href="https://www.instagram.com/pk_photography_41"
                           target="_blank"
                           style="color:inherit; text-decoration:none;"
                           onmouseover="this.style.color='#D4A017'"
                           onmouseout="this.style.color=''">
                            @pk_photography_41
                        </a>
                    </li>

                    {{-- WhatsApp CTA --}}
                    <li class="pt-2">
                        <a href="https://wa.me/919994141294?text=Hello%20PK%20Photography!%20I%20am%20interested%20in%20your%20services."
                           target="_blank"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white transition-all duration-300 hover:scale-105"
                           style="background: linear-gradient(135deg, #25D366, #128C7E);
                                  box-shadow: 0 4px 15px rgba(37,211,102,0.3);
                                  text-decoration:none;">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                            </svg>
                            WhatsApp Us
                        </a>
                    </li>
                    <li>
    <a href="{{ route('order.track') }}"
       class="text-gray-400 text-sm flex items-center gap-2 transition-colors duration-200"
       style="text-decoration:none;"
       onmouseover="this.style.color='#D4A017'"
       onmouseout="this.style.color=''">
        <span class="w-1.5 h-1.5 rounded-full flex-shrink-0"
              style="background:#B8860B;"></span>
        🔍 Track Order
    </a>
</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div style="border-top: 1px solid rgba(184,134,11,0.2);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6
                    flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-500">
                © {{ date('Y') }}
                <span style="color:#D4A017;">PK Photography</span>.
                All rights reserved.
            </p>
            <div class="flex items-center gap-4 text-xs text-gray-600">
                <a href="mailto:pkphotography41@gmail.com"
                   style="color:#B8860B; text-decoration:none;"
                   onmouseover="this.style.color='#D4A017'"
                   onmouseout="this.style.color='#B8860B'">
                    pkphotography41@gmail.com
                </a>
                <span style="color:rgba(184,134,11,0.3);">•</span>
                <a href="https://www.instagram.com/pk_photography_41"
                   target="_blank"
                   style="color:#B8860B; text-decoration:none;"
                   onmouseover="this.style.color='#D4A017'"
                   onmouseout="this.style.color='#B8860B'">
                    @pk_photography_41
                </a>
            </div>
            <p class="text-xs italic" style="color:rgba(184,134,11,0.6);">
                "Every Picture Tells A Story"
            </p>
        </div>
    </div>
</footer>