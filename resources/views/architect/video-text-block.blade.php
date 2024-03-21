<div class="content-padding">
    <div class="container">
        <div
            @class([
                'row',
                'flex-lg-row-reverse' => $alignment === 'right'
            ])
        >
            <div class="col-lg-6">
                <x-general.video :$video />
            </div>
            <div class="col-lg-6">
                {!! $description !!}
            </div>
        </div>
    </div>
</div>
