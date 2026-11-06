<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" dir="{{ $textDirection ?? 'ltr' }}"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title','TechTrac LTD — Hosting that simply works')</title>
@include('partials.seo-meta',['title'=>trim($__env->yieldContent('title','TechTrac LTD — Hosting that simply works')),'description'=>trim($__env->yieldContent('meta_description','Compare hosting resources and applications with TechTrac LTD.'))])
@include('partials.locale-alternates')
<link rel="icon" type="image/png" href="{{ asset('themes/techtrac/assets/images/lov/favicon.png') }}">
@yield('styles')
@stack('styles')
<link rel="stylesheet" href="{{ asset('themes/techtrac/assets/css/lov-port.css') }}?v=3.0.1">
{!! hook_output('ClientAreaHeadOutput',['user'=>auth()->user()]) !!}
<link rel="stylesheet" href="{{ asset('themes/techtrac/assets/css/lov-reference-heroes.css') }}?v=3.1.0">
</head><body style="margin:0;background:#050912"><!-- TechTrac marketing navbar 3.0.1 -->
<a class="lo-skip" href="#lo-main">Skip to content</a>
@include('ttlov.nav')
<main class="lov" id="lo-main">@yield('content')</main>
@include('ttlov.footer')
<script defer src="{{ asset('themes/techtrac/assets/js/lov-port.js') }}?v=3.0.1"></script>
@yield('scripts')
@stack('scripts')
{!! hook_output('ClientAreaFooterOutput',['user'=>auth()->user()]) !!}
</body></html>
