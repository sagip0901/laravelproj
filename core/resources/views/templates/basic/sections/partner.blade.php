@php
    $partnerContent = getContent('partner.content', true);
    $partnerElements = getContent('partner.element', orderById: true);
@endphp

<section class="partner py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-1">{{ __(@$partnerContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$partnerContent->data_values->subheading) }} </p>
        </div>
        <div class="partner-logos flex-align">
            @foreach ($partnerElements as $partnerElement)
                <div class="partner-logos__item">
                    <img src="{{ frontendImage('partner', @$partnerElement->data_values->image, '160x60') }}" alt="@lang('image')">
                </div>
            @endforeach
        </div>
    </div>
</section>

@if (!app()->offsetExists('slick_style'))
    @push('style-lib')
        <link href="{{ $activeTemplateTrue . 'css/slick.css' }}" rel="stylesheet">
    @endpush
    @php app()->offsetSet('slick_style',true) @endphp
@endif

@if (!app()->offsetExists('slick_lib'))
    @push('script-lib')
        <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
    @endpush

    @php app()->offsetSet('slick_lib',true) @endphp
@endif

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.partner-logos').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 1000,
                pauseOnHover: true,
                speed: 2000,
                dots: false,
                arrows: false,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
                responsive: [{
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 3
                        }
                    }
                ]
            });

        })(jQuery);
    </script>
@endpush
