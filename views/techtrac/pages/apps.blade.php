@extends('ttlov.layouts.marketing')
@section('title', 'App Hosting — TechTrac')
@section('meta_description', 'Explore applications, compare hosting resources and configure the service your project needs.')
@section('styles')
@parent

<link rel="stylesheet" href="{{ asset('themes/techtrac/assets/css/lov-port.css') }}?v=3.0.0">
<link
    rel="stylesheet"
    href="{{ asset('themes/techtrac/assets/css/app-landing.css') }}?v=3.0.0"
>
@endsection
@section('content')
<!-- TechTrac App public navbar 3.0.1 -->
<!-- TechTrac Lovable App Hosting port 3.0.0 -->
@php
$apRaw=collect($apps ?? [])->filter(fn($a)=>is_array($a))->values();
$apApps=[];$apSeen=[];
foreach($apRaw as $i=>$a){
 $name=trim((string)($a['name'] ?? '')) ?: trim((string)($a['slug'] ?? 'Application'));
 $key=trim((string)($a['slug'] ?? '')) ?: 'app-'.$i;
 if(isset($apSeen[$key]))continue;$apSeen[$key]=true;
 $description=trim(strip_tags((string)($a['description'] ?? '')));
 $summary=trim(strip_tags((string)($a['tagline'] ?? ''))) ?: $description;
 $raw=$a['categories'] ?? [];if(empty($raw))$raw=$a['category'] ?? [];
 if(is_string($raw))$raw=[$raw];elseif(is_array($raw)&&array_key_exists('name',$raw))$raw=[$raw];elseif(!is_array($raw))$raw=[];
 $cats=collect($raw)->map(fn($c)=>is_array($c)?($c['name'] ?? ''):$c)->filter(fn($c)=>is_string($c))->map(fn($c)=>trim(strip_tags($c)))->filter()->unique()->values()->all();
 $logo=(string)($a['logo_url_local'] ?? '');
 if(!(str_starts_with($logo,'/')&&!str_starts_with($logo,'//')||str_starts_with($logo,'https://')))$logo='';
  // TechTrac reference catalogue logos 3.1.0
 $loLogoMap=['n8n'=>'n8n','wordpress'=>'wordpress','openlitespeed wordpress'=>'wordpress','watchtower'=>'watchtower','adguard'=>'adguard','adguard home'=>'adguard','bookstack'=>'bookstack','chatwoot'=>'chatwoot','docker'=>'docker','discourse'=>'discourse','drupal'=>'drupal','apache'=>'apache','apache http server'=>'apache','authelia'=>'authelia','alpine linux'=>'alpinelinux','alpine'=>'alpinelinux'];
 $loLogoKey=mb_strtolower(trim($name));
 if(isset($loLogoMap[$loLogoKey]))$logo=asset('themes/techtrac/assets/images/lov/logos/'.$loLogoMap[$loLogoKey].'.svg');
 $apApps[]=['key'=>$key,'name'=>$name ?: 'Application','summary'=>$summary,'description'=>$description ?: $summary,'categories'=>$cats ?: ['Uncategorised'],'logo'=>$logo];
}
$apGroups=collect($groups ?? []);$apStrip=array_slice($apApps,0,12);
@endphp
<div class="lov ap-page" data-lov-page>
@include('ttlov.heroes.app')
@include('ttlov.marquee')
<section class="ap-section" id="ap-features"><div class="ap-wrap"><div class="ap-section-head"><h2>A clearer path to application hosting.</h2><p>Explore the software, review the plan and confirm the requirements. Your product configuration defines the resources and options available.</p></div><div class="ap-bento">
<article class="ap-feature ap-feature--wide"><div class="ap-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M13 3 4 14h7v7l9-11h-7V3Z"/></svg></div><h3>Discover what you can run</h3><p>Search the offered catalogue, read application descriptions and choose a suitable hosting product. Application selection is available where the selected plan supports it.</p></article>
<article class="ap-feature ap-feature--tall"><div class="ap-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="m12 3 8 4v10l-8 4-8-4V7l8-4Zm0 8L4 7m8 4 8-4m-8 4v10"/></svg></div><h3>Know your resource allocation</h3><p>Compare the listed CPU, memory, storage and application limits. Ask us to clarify any resource or isolation requirements not stated in your chosen plan.</p><p class="ap-graphic-label">Illustrative resource graphic — not live usage.</p><div class="ap-graphic" aria-hidden="true"><i></i><i></i><i></i></div></article>
<article class="ap-feature"><h3>Plan for your application data</h3><p>Check storage capacity, persistence, backup scope and restore options in the selected product. Confirm your needs before deploying important data.</p></article>
<article class="ap-feature"><h3>Connect your domain</h3><p>Review the domain and certificate options supported by your product. Contact TechTrac if you need help confirming routing or SSL requirements.</p></article>
</div></div></section>
<section class="ap-section ap-catalogue-section ap-anchor" id="ap-catalogue"><div class="ap-wrap"><div class="ap-section-head"><h2>Find your next application.</h2><p>Search the catalogue, filter by category and open an application for more information.</p></div>
<div class="ap-catalogue" data-ap-catalogue><aside class="ap-filter"><h3>Browse applications</h3><div class="ap-field"><label for="ap-search">Search by name</label><input class="ap-input" id="ap-search" type="search" placeholder="Search applications…" data-ap-search aria-controls="ap-grid"></div><div class="ap-field"><label for="ap-category">Category</label><select class="ap-input" id="ap-category" data-ap-category aria-controls="ap-grid"><option value="">All categories</option></select></div><p class="ap-count" data-ap-count role="status" aria-live="polite">{{ count($apApps) }} applications listed</p><p class="ap-filter-note">Category labels come from catalogue metadata. Availability depends on your selected plan.</p></aside>
<div><div class="ap-app-grid" id="ap-grid">@foreach($apApps as $a)<article class="ap-app" data-ap-key="{{ $a['key'] }}"><button class="ap-app-open" type="button" aria-label="View details for {{ $a['name'] }}" aria-haspopup="dialog" aria-controls="ap-dialog">@if($a['logo']!=='')<img src="{{ $a['logo'] }}" width="36" height="36" alt="" loading="lazy">@else<span class="ap-initial" aria-hidden="true">{{ mb_strtoupper(mb_substr($a['name'],0,1)) }}</span>@endif<span class="ap-app-name">{{ $a['name'] }}</span></button><p class="ap-app-preview" aria-hidden="true">{{ \Illuminate\Support\Str::limit($a['summary'] ?: 'Open application details.',140) }}</p></article>@endforeach</div><p class="ap-empty" data-ap-empty @if(count($apApps)) hidden @endif>The application catalogue is currently unavailable. You can still review the hosting plans below.</p><div class="ap-show" data-ap-actions hidden><button class="ap-button ap-button--secondary" type="button" data-ap-toggle aria-controls="ap-grid" aria-expanded="false">Show All Apps</button></div><p class="ap-catalogue-note">A catalogue listing does not guarantee compatibility with every hosting product.</p></div>
<script type="application/json" data-ap-data>{!! json_encode($apApps, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_INVALID_UTF8_SUBSTITUTE) !!}</script>
</div></div></section>
<dialog class="ap-dialog" id="ap-dialog" aria-labelledby="ap-dialog-title"><div class="ap-dialog-head"><p class="ap-kicker">APPLICATION DETAILS</p><button class="ap-button ap-button--secondary" type="button" data-ap-close>Close</button></div><h2 id="ap-dialog-title"></h2><p class="ap-dialog-description" data-ap-description></p><p class="ap-dialog-note">Confirm application compatibility, resource requirements and deployment options in your selected plan.</p><a class="ap-button" href="#ap-pricing" data-ap-plans>View Hosting Plans</a></dialog>
<section class="ap-section ap-pricing ap-anchor" id="ap-pricing"><div class="ap-wrap"><div class="ap-section-head"><h2>Resources for your next project.</h2><p>Compare the current plans and configured limits. Review billing options and the complete order summary before checkout.</p></div>
@forelse($apGroups as $group)<div class="ap-group">@if($apGroups->count()>1)<h3 class="ap-group-title">{{ $group->name }}</h3>@endif<div class="ap-pricing-grid">
@forelse($group->products as $product)
@php
$priced=$product->pricedCycles(($currency ?? null)?->id);$cycle=(string)array_key_first($priced);$price=$priced[$cycle] ?? null;
$label=['monthly'=>'month','quarterly'=>'3 months','semiannually'=>'6 months','annually'=>'year','biennially'=>'2 years','triennially'=>'3 years'][$cycle] ?? $cycle;
@endphp
<article class="ap-plan {{ $product->is_featured ? 'ap-plan--featured' : '' }}"><h3>{{ $product->name }}</h3>@if($product->description)<p class="ap-plan-desc">{{ \Illuminate\Support\Str::limit(strip_tags($product->description),200) }}</p>@endif
@if($product->pay_type==='free' && $price!==null)<div class="ap-price">{{ __('common.billing.free') }}</div>@elseif($price!==null)<div class="ap-price">{{ display_money_fmt($price) }} <small>{{ $product->pay_type==='onetime' ? 'one-time' : '/ '.$label }}</small></div>@else<div class="ap-price" style="font-size:23px">{{ __('client.store.contact_us') }}</div>@endif
<p class="ap-price-note">Review setup charges, available cycles and applicable taxes in the order summary.</p><ul class="ap-resources">@forelse($product->resourceSummary() as $res)<li>{{ $res['text'] }}</li>@empty<li>Review the product configuration for service specifications.</li>@endforelse</ul>
@if($product->outOfStock())<span class="ap-button ap-button--secondary" aria-disabled="true">{{ __('client.cart.out_of_stock') }}</span>@else<a class="ap-button {{ $product->is_featured ? '' : 'ap-button--secondary' }}" href="{{ route('client.store.configure',$product) }}">Select Plan</a>@endif</article>
@empty<p class="ap-empty">No app-hosting plans are currently listed in this category.</p>@endforelse</div></div>
@empty<p class="ap-empty">No app-hosting plans are currently listed. Contact TechTrac to discuss your requirements.</p>@endforelse
<p class="ap-pricing-note">Your application's limits and deployment options depend on the selected product.</p></div></section>
<section class="ap-section ap-faq"><div class="ap-wrap"><div class="ap-section-head"><h2>Before you deploy.</h2></div><details><summary>Where do I select my application?</summary><p>The native product-configuration screen provides application selection when the product is configured to support it.</p></details><details><summary>Can I install unlimited applications?</summary><p>Check the actual application allowance and resource limits of your plan. Catalogue size is not an application allowance.</p></details><details><summary>Are backups, updates and SSL management included?</summary><p>Check your product description and configuration. These services should not be assumed unless explicitly included.</p></details><details><summary>Can I migrate an existing application?</summary><p>Contact TechTrac with the runtime, version, database and storage requirements before ordering.</p></details></div></section>
<section class="ap-help"><h2>Not sure which plan fits?</h2><p>Discuss your application and resource requirements before placing an order.</p><a class="ap-button" href="{{ url('/client/contact') }}">Contact TechTrac</a></section>
</div>
<script defer src="{{ asset('themes/techtrac/assets/js/app-landing.js') }}?v=3.0.0"></script>
<script defer src="{{ asset('themes/techtrac/assets/js/lov-port.js') }}?v=3.0.0"></script>
@endsection
