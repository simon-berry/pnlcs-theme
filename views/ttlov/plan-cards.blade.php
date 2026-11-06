
@forelse(collect($loProducts ?? []) as $product)
    @php
        $loCycles = $product->pricedCycles(($currency ?? null)?->id);
        $loCycle  = (string) array_key_first($loCycles);
        $loPrice  = $loCycles[$loCycle] ?? null;

        $loLabel = [
            'monthly'      => 'month',
            'quarterly'    => '3 months',
            'semiannually' => '6 months',
            'annually'     => 'year',
            'biennially'   => '2 years',
            'triennially'  => '3 years',
        ][$loCycle] ?? $loCycle;
    @endphp

    <article class="lo-card lo-plan {{ $product->is_featured ? 'lo-plan-featured' : '' }}">
        <h3>{{ $product->name }}</h3>

        @if($product->description)
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 180) }}</p>
        @endif

        <div class="lo-price">
            @if($product->pay_type === 'free')
                {{ __('common.billing.free') }}
            @elseif($loPrice !== null)
                {{ display_money_fmt($loPrice) }}
                <small>
                    {{ $product->pay_type === 'onetime' ? 'one-time' : '/ ' . $loLabel }}
                </small>
            @else
                <span style="font-size:23px">Contact us</span>
            @endif
        </div>

        <p class="lo-note">
            Review setup fees, billing cycles and applicable taxes before checkout.
        </p>

        <ul class="lo-resources">
            @forelse($product->resourceSummary() as $loRes)
                <li>{{ $loRes['text'] }}</li>
            @empty
                <li>Review the product configuration for service specifications.</li>
            @endforelse
        </ul>

        @if($product->outOfStock())
            <span class="lo-btn lo-btn--ghost" aria-disabled="true">Out of stock</span>
        @else
            <a class="lo-btn {{ $product->is_featured ? '' : 'lo-btn--ghost' }}"
               href="{{ route('client.store.configure', $product) }}">
                Configure plan
            </a>
        @endif
    </article>
@empty
    <div class="lo-empty">
        No plans are listed here.
        <a href="{{ route('client.store') }}">Browse the full store</a>.
    </div>
@endforelse