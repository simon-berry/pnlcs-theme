@forelse($groups as $group)
<section class="tt-group"><div class="tt-group-heading"><h2>{{ $group->name }}</h2><span aria-hidden="true"></span></div><div class="tt-grid">
@forelse($group->products as $product)
@php
$priced=$product->pricedCycles($currency?->id ?? null);$cycle=(string) array_key_first($priced);$price=$priced[$cycle] ?? null;
@endphp
<article class="tt-card {{ $product->is_featured ? 'tt-featured' : '' }}"><p class="tt-badge">{{ $product->is_featured ? __('client.store.most_popular') : $group->name }}</p><h3>{{ $product->name }}</h3>
@if($price !== null && $product->pay_type === 'free')<div class="tt-price">{{ __('common.billing.free') }}</div>@elseif($price !== null)<div class="tt-price">{{ display_money_fmt($price) }} <small>/ {{ $cycle }}</small></div>@else<div class="tt-price tt-price-text">{{ __('client.store.contact_us') }}</div>@endif
@if($product->description)<p class="tt-description">{{ Str::limit(strip_tags($product->description),240) }}</p>@endif
<ul class="tt-resources">@foreach($product->resourceSummary() as $res)<li><span aria-hidden="true">✓</span>{{ $res['text'] }}</li>@endforeach</ul>
@if($product->outOfStock())<span class="tt-button tt-disabled" aria-disabled="true">{{ __('client.cart.out_of_stock') }}</span>@else<a class="tt-button" href="{{ route('client.store.configure',$product) }}">{{ __('client.store.order_now') }}</a>@endif</article>
@empty<p class="tt-empty">No plans are currently listed in this category.</p>@endforelse</div></section>
@empty<p class="tt-empty">No plans are currently listed. Contact TechTrac to discuss your requirements.</p>@endforelse
