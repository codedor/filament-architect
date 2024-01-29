<div class="container">
    <div class="row">
        @foreach ($cards as $card)
            <div
                @class([
                    'col-md-6',
                    'col-lg-4' => count($cards) > 2
                ])
            >
                <x-card
                    :item="$card"
                    :title="$card['title']"
                    :intro="$card['description']"
                    :image="$card['image']"
                    :route="$card['button'] ? lroute($card['button']['link']) : null"
                />
            </div>
        @endforeach
    </div>
</div>
