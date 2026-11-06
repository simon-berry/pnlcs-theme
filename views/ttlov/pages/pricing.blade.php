@extends('ttlov.layouts.marketing')
@section('title','Plans & Pricing — TechTrac LTD')
@section('content')
@include('ttlov.heroes.pricing')
<section class="lo-section"><div class="lo-wrap"><div class="lo-grid">@include('ttlov.plan-cards',['loProducts'=>collect($groups ?? [])->flatMap->products->filter(fn($p)=>!$p->outOfStock())->values(),'currency'=>$currency ?? null])</div></div></section>
@endsection
