@php
    $bannerContent = getContent('banner.content', true);
    $bannerElements = getContent('banner.element', orderById: true);
@endphp

<section class="banner-section">
    <div class="container">
        <div class="row gy-sm-5 gy-4">
            <div class="col-lg-8">
                <div class="banner-content">
                    <h1 class="banner-content__title">{{ __(@$bannerContent->data_values->heading) }} <span class="text--gradient" id="element"></span> </h1>
                    <p class="banner-content__desc fs-18">{{ __(@$bannerContent->data_values->short_description) }}</p>
                    <div class="buttons flex-align gap-sm-4 gap-2">
                        <a class="btn btn--base pill" href="{{ url(@$bannerContent->data_values->button_one_link) }}">
                            {{ __(@$bannerContent->data_values->button_one) }}
                        </a>
                        <a class="btn btn-outline--base pill" href="{{ url(@$bannerContent->data_values->button_two_link) }}">
                            {{ __(@$bannerContent->data_values->button_two) }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="banner-thumb">
                    <img src="{{ frontendImage('banner', @$bannerContent->data_values->banner_image, '650x450') }}" alt="banner-img">
                </div>
            </div>
        </div>
    </div>
</section>
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/typed.umd.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";

        (function($) {
            var typed = new Typed("#element", {
                strings: [
                    @foreach ($bannerElements as $bannerElement)
                        "{{ __(@$bannerElement->data_values->tag) }}",
                    @endforeach
                ],
                stringsElement: '#typed-strings',
                typeSpeed: 50,
                backSpeed: 50,
                backDelay: 1000,
                startDelay: 100,
                cursorChar: '|',
                loop: true,
            });
        })(jQuery)
    </script>
@endpush
