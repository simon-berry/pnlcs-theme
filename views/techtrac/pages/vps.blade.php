@extends('ttlov.layouts.marketing')
@section('title','VPS Hosting — TechTrac LTD')
@section('content')
@php $loProducts=collect($groups ?? [])->flatMap->products->filter(fn($p)=>!$p->outOfStock())->values(); @endphp
<section class="lo-hero"><div class="lo-wrap"><p class="lo-kicker">VPS Hosting / TechTrac LTD</p><h1>Your server. <span class="lo-gradient">Your workload.</span></h1><p class="lo-lead">Compare live VPS products and configured resources. Check operating-system, management and network requirements before ordering.</p><div class="lo-actions"><a class="lo-btn" href="{{ route('client.store') }}">View available servers</a></div></div></section>
<section class="lo-section"><div class="lo-wrap"><div class="lo-grid">@include('ttlov.plan-cards',['loProducts'=>$loProducts,'currency'=>$currency ?? null])</div></div></section>
@endsection
