@php
$ttServiceLinks=['techtrac.vps'=>'VPS Hosting','techtrac.apps'=>'App Hosting','techtrac.domains'=>'Domain & SSL'];
@endphp
<nav class="tt-categories" aria-label="Store services"><a class="tt-chip" href="{{ route('client.store') }}">All services</a>
@foreach($ttServiceLinks as $routeName=>$label)
@if(\Illuminate\Support\Facades\Route::has($routeName))<a class="tt-chip" href="{{ route($routeName) }}" @if(request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}</a>@endif
@endforeach</nav>
