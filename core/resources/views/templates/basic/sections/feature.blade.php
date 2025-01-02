@php
    $featureContent = getContent('feature.content', true);
    $featureElements = getContent('feature.element', orderById: true);
@endphp

<section class="feature py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-2">{{ __(@$featureContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$featureContent->data_values->subheading) }}</p>
        </div>
        <div class="feature-item-wrapper">
            @foreach ($featureElements as $featureElement)
                <div class="feature-item">
                    <div class="feature-item__inner">
                        <span class="feature-item__icon text--gradient">@php  echo @$featureElement->data_values->icon @endphp</span>
                        <h5 class="feature-item__title">{{ __(@$featureElement->data_values->title) }}</h5>
                        <p class="feature-item__desc">{{ __(@$featureElement->data_values->description) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
