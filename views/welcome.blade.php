@extends('ttlov.layouts.marketing')
@section('title','TechTrac LTD — Hosting that simply works')
@section('content')
@php $loHomeProducts=collect($products ?? []); @endphp
@include('ttlov.home-hero')
@include('ttlov.marquee')
<section class="lo-section"><div class="lo-wrap"><p class="lo-kicker">Why TechTrac</p><h2>A clearer way to host.</h2><p class="lo-copy">Choose the resources, applications and service options that fit your project. Confirm the technical details before you order.</p><div class="lo-grid lo-grid-two lo-checker" style="margin-top:44px">
@foreach([['Resources matched to your workload',"Compare the allocations and limits listed for each product. Check your application's requirements before choosing a plan."],['Your client portal','Access your account, review your services and manage orders through the client area.'],['Storage that fits your service',"Review the included storage and any available options in your selected product's specification."],['Applications, without the guesswork','Browse the offered catalogue and confirm runtime, deployment and management options for the plan you choose.']] as $loFeature)
<article class="lo-card"><div class="lo-number">0{{ $loop->iteration }}</div><h3>{{ $loFeature[0] }}</h3><p>{{ $loFeature[1] }}</p></article>@endforeach
</div></div></section>
<section class="lo-section"><div class="lo-wrap"><div class="lo-section-head"><div><p class="lo-kicker">Plans</p><h2>Choose your starting point.</h2></div><a href="{{ route('client.store') }}">Compare all plans →</a></div><div class="lo-grid">@include('ttlov.plan-cards',['loProducts'=>$loHomeProducts->take(3),'currency'=>$currency ?? null])</div></div></section>
<section class="lo-section"><div class="lo-wrap"><h2>From idea to your next service.</h2><div class="lo-grid" style="margin-top:40px">@foreach([['Choose your plan','Compare the resources, service limits and billing options listed for your project.'],['Configure what you need','Select the options available for your chosen product. App selection appears where the plan supports it.'],['Review and get started','Check the order summary and follow the activation or provisioning instructions for your service.']] as $loStep)<article class="lo-card lo-step"><div class="lo-number">{{ $loop->iteration }}</div><h3>{{ $loStep[0] }}</h3><p>{{ $loStep[1] }}</p></article>@endforeach</div></div></section>
<section class="lo-section"><div class="lo-wrap"><div class="lo-callout"><div><h2>Have a project in mind?</h2><p class="lo-copy">Tell us what you need before choosing a service.</p></div><a class="lo-btn lo-btn--ghost" href="{{ url('/client/contact') }}">Contact TechTrac</a></div></div></section>
@endsection
