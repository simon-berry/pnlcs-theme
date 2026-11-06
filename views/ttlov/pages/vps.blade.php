@extends('ttlov.layouts.marketing')

@section('title','VPS Hosting — TechTrac')
@section('meta_description','Dedicated virtual private servers with isolated resources, full control and room for your projects to grow.')

@section('styles')
@parent
<link rel="stylesheet" href="{{ asset('themes/techtrac/assets/css/theme.css') }}?v=2.1.0">
<link rel="stylesheet" href="{{ asset('themes/techtrac/assets/css/vps-hosting.css') }}?v=2.1.0">
@endsection

@section('content')
<div class="lov lov-vps">

    {{-- Hero --}}
    <section class="lo-hero vps-hero">
        <div class="lo-wrap vps-hero-inner">
            <p class="lo-kicker">TECHTRAC LTD / VIRTUAL SERVERS</p>
            <h1>Dedicated VPS Hosting for growing projects.</h1>
            <p class="lo-lead">
                Move from shared hosting to your own virtual private server with guaranteed CPU, memory
                and SSD storage. Run websites, applications and services on infrastructure you control.
            </p>
            <div class="lo-actions vps-hero-actions">
                <a class="lo-btn" href="{{ route('client.store') }}">
                    View VPS plans
                </a>
                <a class="lo-btn lo-btn--ghost" href="{{ url('/client/contact') }}">
                    Talk to us about your workload
                </a>
            </div>

            <div class="vps-hero-points">
                <span>Isolated resources</span>
                <span>Root access</span>
                <span>Scale on demand</span>
            </div>
        </div>
    </section>

    <main class="lo-wrap vps-main">

        {{-- Section: VPS vs shared hosting --}}
        <section class="vps-section vps-section--contrast">
            <div class="vps-section-inner">
                <h2>How VPS Hosting differs from shared hosting.</h2>
                <p>
                    Shared hosting runs many sites inside a single operating system, sharing one pool of CPU, memory and storage.
                    A VPS gives you an isolated virtual machine with its own OS and dedicated resources, closer to a small dedicated server.
                </p>
                <div class="vps-grid vps-grid--three">
                    <article class="vps-card vps-card--contrast">
                        <h3>Dedicated performance</h3>
                        <p>
                            Each VPS has reserved CPU and RAM for your workloads, reducing “noisy neighbour” effects from other customers
                            on the same physical hardware.
                        </p>
                    </article>
                    <article class="vps-card vps-card--contrast">
                        <h3>Own operating system</h3>
                        <p>
                            You run your own copy of the operating system and packages, with root access to install runtimes, databases
                            and services as needed.
                        </p>
                    </article>
                    <article class="vps-card vps-card--contrast">
                        <h3>Stronger isolation</h3>
                        <p>
                            VPS environments are segmented at the virtualization layer, so your filesystem and processes stay separate
                            from other tenants on the host server.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- Section: What you can run --}}
        <section class="vps-section vps-section--usecases">
            <div class="vps-section-inner">
                <h2>What runs well on TechTrac VPS Hosting.</h2>
                <div class="vps-grid vps-grid--three">
                    <article class="vps-card">
                        <h3>Websites & stores</h3>
                        <p>
                            High‑traffic sites, e‑commerce stores and booking systems benefit from dedicated resources and faster page
                            loads during busy periods.
                        </p>
                    </article>
                    <article class="vps-card">
                        <h3>Applications & APIs</h3>
                        <p>
                            Host web applications, APIs, background workers and containers on your own stack, with the freedom to tune
                            performance and security.
                        </p>
                    </article>
                    <article class="vps-card">
                        <h3>Internal tools & services</h3>
                        <p>
                            Run internal dashboards, integrations, file or mail services on infrastructure you control, with options to
                            segment environments per project.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- Section: Included with TechTrac VPS --}}
        <section class="vps-section vps-section--included">
            <div class="vps-section-inner">
                <h2>What TechTrac includes with VPS Hosting.</h2>
                <div class="vps-grid vps-grid--two">
                    <article class="vps-card vps-card--included">
                        <h3>Platform & management</h3>
                        <ul class="vps-list vps-list--check">
                            <li>Root SSH access and control panel options where supported.</li>
                            <li>DNS management, SSL certificates and firewall configuration.</li>
                            <li>Options for automated backups and snapshots depending on plan.</li>
                        </ul>
                    </article>
                    <article class="vps-card vps-card--included">
                        <h3>Support & monitoring</h3>
                        <ul class="vps-list vps-list--check">
                            <li>24/7 monitoring from our datacentres.</li>
                            <li>Help choosing the right VPS size and storage for your workload.</li>
                            <li>Guidance on migration from existing hosting.</li>
                        </ul>
                    </article>
                </div>
                <p class="vps-note">
                    Exact resources, backup scope and management tools vary by plan. You can review the specification for each VPS
                    configuration in the store before you order.
                </p>
            </div>
        </section>

        {{-- Section: VPS plans (from $groups) --}}
        @if(($groups ?? collect())->isNotEmpty())
        <section class="vps-section vps-section--plans">
            <div class="vps-section-inner">
                <h2>Choose your VPS plan.</h2>
                <p>
                    These plans are drawn directly from the TechTrac store. Compare CPU, memory, storage and billing options, then
                    review the full order summary before checkout.
                </p>

                @foreach($groups as $group)
                    <div class="vps-group">
                        @if(($groups ?? collect())->count() > 1)
                            <h3 class="vps-group-title">{{ $group->name }}</h3>
                        @endif

                        <div class="vps-grid vps-grid--plans">
                            @forelse($group->products as $product)
                                @php
                                    $priced = $product->pricedCycles($currency?->id);
                                    $cycle  = (string) (array_key_first($priced) ?? 'monthly');
                                    $price  = $priced[$cycle] ?? null;
                                @endphp
                                <article class="vps-plan {{ $product->is_featured ? 'vps-plan--featured' : '' }}">
                                    <h3 class="vps-plan-name">{{ $product->name }}</h3>

                                    @if($product->description)
                                        <p class="vps-plan-desc">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 180) }}</p>
                                    @endif

                                    @if($product->pay_type === 'free' && $price !== null)
                                        <div class="vps-plan-price">
                                            <span class="vps-price-main">{{ __('common.billing.free') }}</span>
                                        </div>
                                    @elseif($price !== null)
                                        <div class="vps-plan-price">
                                            <span class="vps-price-main">{{ display_money_fmt($price) }}</span>
                                            <span class="vps-price-cycle">
                                                {{ __('common.billing.'.str_replace('semiannually','semi_annually',$cycle)) }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="vps-plan-price vps-plan-price--contact">
                                            <span class="vps-price-main">Contact us for pricing</span>
                                        </div>
                                    @endif

                                @php
                                    $res = $product->resourceSummary();
                                    \Log::info('VPS resourceSummary', [
                                        'product_id' => $product->id,
                                        'res' => $res,
                                    ]);
                                @endphp
@php
    $os = $product->osLabel();
@endphp

@if($os)
    <p class="vps-plan-os">
        <strong>OS:</strong> {{ $os }}
    </p>
@endif
@if($res)
    <ul class="vps-resources">
        @foreach($res as $r)
            <li>
                <span class="vps-resource-label">{{ $r['label'] ?? '' }}</span>
                <span class="vps-resource-value">{{ $r['text'] ?? '' }}</span>
            </li>
        @endforeach
    </ul>
@else
    <p class="vps-resources-note">
        Review the product configuration for detailed resource and limit information.
    </p>
@endif

                                    <p class="vps-plan-note">
                                        Review setup charges, available billing cycles and applicable taxes in the order summary.
                                    </p>

                                    <a class="lo-btn vps-plan-btn"
                                       href="{{ route('client.store.configure', $product) }}">
                                        Select VPS plan
                                    </a>
                                </article>
                            @empty
                                <p class="vps-empty">
                                    No VPS plans are currently listed in this group. Visit the store to review current availability.
                                </p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Section: FAQ --}}
        <section class="vps-section vps-section--faq">
            <div class="vps-section-inner">
                <h2>VPS Hosting — common questions.</h2>
                <div class="vps-faq">
                    <article class="vps-faq-item">
                        <h3>Do I really need a VPS?</h3>
                        <p>
                            If your site or application is starting to slow down on shared hosting, or you need custom software and
                            more control over the server environment, a VPS is usually the next step.
                        </p>
                    </article>
                    <article class="vps-faq-item">
                        <h3>Can I install my own software?</h3>
                        <p>
                            Yes. VPS hosting includes root‑level access on the virtual machine, so you can install runtimes,
                            databases, application servers and other packages your stack requires.
                        </p>
                    </article>
                    <article class="vps-faq-item">
                        <h3>What if I outgrow my current VPS plan?</h3>
                        <p>
                            You can scale vertically by upgrading to a larger plan with more CPU, RAM and storage, or horizontally
                            by adding more VPS instances and distributing workloads.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- Final CTA --}}
        <section class="vps-section vps-section--cta">
            <div class="vps-section-inner vps-section-inner--cta">
                <div class="vps-cta-copy">
                    <h2>Ready to move to VPS Hosting?</h2>
                    <p>
                        Compare plans in the TechTrac store, configure the resources your project needs, and start on dedicated
                        infrastructure with room to grow.
                    </p>
                </div>
                <div class="vps-cta-actions">
                    <a class="lo-btn" href="{{ route('client.store') }}">
                        View VPS plans in the store
                    </a>
                    <a class="lo-btn lo-btn--ghost" href="{{ url('/client/contact') }}">
                        Talk to us before you order
                    </a>
                </div>
            </div>
        </section>

    </main>
</div>
@endsection