@php
$loLinks = [
    [
        'Home',
        url('/'),
        request()->is('/'),
    ],
    [
        'Plans & Pricing',
        \Illuminate\Support\Facades\Route::has('techtrac.lov.pricing')
            ? route('techtrac.lov.pricing')
            : route('client.store'),
        request()->routeIs('techtrac.lov.pricing') || request()->routeIs('client.store'),
    ],
];

foreach ([
    'techtrac.lov.wordpress' => 'WordPress',
    'techtrac.lov.n8n'       => 'n8n',
    'techtrac.vps'           => 'VPS Hosting',   // NEW
    'techtrac.apps'          => 'App Hosting',
    'techtrac.domains'       => 'Domains & SSL',
] as $loRoute => $loLabel) {
    if (\Illuminate\Support\Facades\Route::has($loRoute)) {
        $loLinks[] = [
            $loLabel,
            route($loRoute),
            request()->routeIs($loRoute),
        ];
    }
}
@endphp

@foreach ($loLinks as [$loLabel, $loUrl, $loCurrent])
    @if(($loMode ?? '') === 'desktop')
        <div class="pn-nav-item" data-tt-shared-link>
    @endif

    <a href="{{ $loUrl }}"
       class="{{ ($loMode ?? '') === 'desktop'
                ? 'pn-nav-link'
                : (($loMode ?? '') === 'mobile' ? 'tt-shared-link' : '') }}"
       data-tt-shared-link
       @if($loCurrent) aria-current="page" @endif>
        {{ $loLabel }}
    </a>

    @if(($loMode ?? '') === 'desktop')
        </div>
    @endif
@endforeach