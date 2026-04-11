{{-- resources/views/shop/whatsapp-redirect.blade.php --}}
@extends('layouts.app')
@section('title', 'Redirecting to WhatsApp')

@section('content')

<div class="min-h-screen flex items-center justify-center py-20 bg-brand-bg">
    <div class="max-w-lg w-full mx-4 text-center">

        {{-- Animated WhatsApp Icon --}}
        <div class="w-28 h-28 rounded-full mx-auto mb-8 flex items-center justify-center animate-float shadow-2xl"
             style="background: linear-gradient(135deg, #25D366, #128C7E); box-shadow: 0 20px 60px rgba(37,211,102,0.4);">
            <svg class="w-16 h-16 text-white fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074