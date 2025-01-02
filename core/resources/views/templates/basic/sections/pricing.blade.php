@php
    $pricingContent = getContent('pricing.content', true);
@endphp
<section class="pricing py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-1">{{ __(@$pricingContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$pricingContent->data_values->subheading) }}</p>
        </div>
        @include('Template::partials.plan_card')
    </div>
</section>
