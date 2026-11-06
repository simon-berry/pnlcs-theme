@extends('ttlov.layouts.marketing')
@section('title','WordPress Hosting — TechTrac LTD')
@section('meta_description','Compare WordPress hosting plans and choose the resources your website needs.')
@section('content')
<!-- TechTrac WordPress group products 1.0.1 -->
@php
$loWordPressPlans=app(\App\Services\TechTracWordPressPlans::class)->products();
$currency=$currency ?? \App\Models\Currency::getDefault();
@endphp
@include('ttlov.heroes.wordpress')
<section class="lo-section"><div class="lo-wrap"><p class="lo-kicker">Built around your WordPress project</p><h2>Start with the right requirements.</h2><div class="lo-grid lo-grid-two" style="margin-top:34px"><article class="lo-card"><h3>Review the actual resources</h3><p>Compare the included memory, storage and service limits against your website's requirements.</p></article><article class="lo-card"><h3>Check themes and plugins</h3><p>Confirm runtime compatibility and any restrictions before moving an existing website.</p></article><article class="lo-card"><h3>Plan the domain and certificate</h3><p>Check your DNS and SSL options for the selected service before launch.</p></article><article class="lo-card"><h3>Clarify backups and updates</h3><p>Confirm what is included, what you manage and how restores work for your product.</p></article></div></div></section>
<section class="lo-section wp-plans" id="wordpress-plans" aria-labelledby="wp-plans-title"><div class="lo-wrap"><p class="lo-kicker">WordPress plans</p><h2 id="wp-plans-title">Choose your WordPress hosting.</h2><p class="lo-copy">Plans below come exclusively from the WordPress hosting product group. Prices, billing cycles, resources and availability come from the live store.</p>
@if($loWordPressPlans->isNotEmpty())<div class="lo-grid" style="margin-top:34px">@include('ttlov.plan-cards',['loProducts'=>$loWordPressPlans,'currency'=>$currency])</div>@else<div class="lo-empty" style="margin-top:28px">No WordPress plans are currently listed on this page. <a href="{{ url('/client/contact') }}">Contact TechTrac</a> to discuss your website.</div>@endif
</div></section>
<section class="lo-section"><div class="lo-wrap"><div class="lo-callout"><div><h2>Moving a WordPress website?</h2><p class="lo-copy">Discuss the files, database, domain and email dependencies before you order.</p></div><a class="lo-btn lo-btn--ghost" href="{{ url('/client/contact') }}">Discuss your website</a></div></div></section>
@endsection
