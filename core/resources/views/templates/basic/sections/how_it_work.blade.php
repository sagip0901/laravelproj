@php
    $howWorkContent = getContent('how_it_work.content', true);
    $howWorkElements = getContent('how_it_work.element', orderById: true);
@endphp
<section class="how-it-work py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-1">{{ __(@$howWorkContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$howWorkContent->data_values->subheading) }}</p>
        </div>
        <div class="row gy-4">
            @foreach ($howWorkElements as $howWorkElement)
                <div class="col-lg-4 col-sm-6 col-xsm-6">
                    <div class="how-it-work-item">
                        <span class="how-it-work-item__icon flex-center">
                            <span class="text--gradient">@php  echo @$howWorkElement->data_values->icon @endphp </span></span>
                        <span class="how-it-work-item__number">{{ $loop->iteration }}</span>
                        <h4 class="how-it-work-item__title">{{ __(@$howWorkElement->data_values->title) }} </h4>
                        <p class="how-it-work-item__desc fs-15"> {{ __(@$howWorkElement->data_values->content) }} </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
