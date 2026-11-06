@extends('ttlov.layouts.marketing')
@section('title','Domains & SSL — TechTrac LTD')
@section('content')
@php $loProducts=collect($groups ?? [])->flatMap->products->filter(fn($p)=>!$p->outOfStock())->values(); @endphp
<section class="lo-hero"><div class="lo-wrap"><p class="lo-kicker">Domains & SSL / TechTrac LTD</p><h1>Your domain. <span class="lo-gradient">Your digital home.</span></h1><p class="lo-lead">Search for a domain and compare the available certificate products. Check eligibility and renewal pricing before purchase.</p><form class="lo-domain" method="get" action="{{ url('/client/domain-search') }}"><input name="domain" type="text" required maxlength="253" placeholder="yourbusiness.co.uk" aria-label="Domain name"><button class="lo-btn" type="submit">Search domains</button></form><div class="lo-actions"><a class="lo-btn lo-btn--ghost" href="{{ route('client.store') }}">Browse domain & SSL products</a></div></div></section>
<section class="lo-section"><div class="lo-wrap"><div class="lo-grid">@include('ttlov.plan-cards',['loProducts'=>$loProducts,'currency'=>$currency ?? null])</div></div></section>
@endsection
