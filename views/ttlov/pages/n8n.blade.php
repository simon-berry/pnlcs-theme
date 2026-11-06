@extends('ttlov.layouts.marketing')
@section('title','n8n Hosting — TechTrac LTD')
@section('content')
@php $loGroup=collect($groups ?? []);$loProducts=$loGroup->flatMap->products->filter(fn($p)=>!$p->outOfStock())->values(); @endphp
@include('ttlov.heroes.n8n')

<section class="lo-section"><div class="lo-wrap"><div class="lo-grid lo-grid-two"><article class="lo-card"><h3>Plan for workflow load</h3><p>Estimate schedules, concurrent runs, webhooks and data processing, then compare against the published resources.</p></article><article class="lo-card"><h3>Check domains and certificates</h3><p>Confirm how DNS, webhook reachability and certificate provisioning work for your selected service.</p></article><article class="lo-card"><h3>Protect workflow data</h3><p>Clarify how credentials and workflow data are stored, backed up and restored. Export before major changes.</p></article><article class="lo-card"><h3>Migration and updates</h3><p>Check version compatibility and re-enter credentials securely after any migration.</p></article></div></div></section>
<section class="lo-section"><div class="lo-wrap"><h2>Available App Hosting plans</h2><div class="lo-grid" style="margin-top:34px">@include('ttlov.plan-cards',['loProducts'=>$loProducts,'currency'=>$currency ?? null])</div></div></section>
@endsection
