@php
    $affiliateContent = getContent('affiliate.content', true);
@endphp

<section class="affiliate py-70">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-7 pe-lg-5">
                <div class="affiliate__content pe-xxl-5">
                    <div class="section-heading style-left">
                        <h2 class="section-heading__title" s-break="-1">{{ __(@$affiliateContent->data_values->heading) }}</h2>
                        <p class="section-heading__desc fs-18">@php echo @$affiliateContent->data_values->description @endphp</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10 ps-xxl-5">
                <div class="affiliate__thumb">
                    <img src="{{ frontendImage('affiliate', @$affiliateContent->data_values->image, '490x450') }}" alt="@lang('image')" class="fit-image">
                </div>
            </div>
        </div>
    </div>
</section>
