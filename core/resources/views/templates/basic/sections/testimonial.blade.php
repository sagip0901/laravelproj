@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', orderById: true);
@endphp

<section class="testimonials py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-1">{{ __(@$testimonialContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$testimonialContent->data_values->subheading) }} </p>
        </div>
        <div class="testimonial-slider">
            @foreach ($testimonialElements as $testimonialElement)
                <div class="testimonial-item">
                    <div class="testimonial-item__content flex-between gap-1">
                        <div class="testimonial-item__info flex-align">
                            <div class="testimonial-item__thumb">
                                <img class="fit-image" src="{{ frontendImage('testimonial', @$testimonialElement->data_values->image, '60x60') }}" alt="@lang('image')">
                            </div>
                            <div class="testimonial-item__details">
                                <h5 class="testimonial-item__name">{{ __(@$testimonialElement->data_values->author) }}</h5>
                            </div>
                        </div>
                        <img class="quote-icon" src="{{ getImage($activeTemplateTrue . 'images/thumbs/quote.png') }}" alt="@lang('image')">
                    </div>
                    <p class="testimonial-item__desc fs-18">{{ __(@$testimonialElement->data_values->quote) }}</p>
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

            $('.testimonial-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                speed: 1500,
                dots: false,
                pauseOnHover: true,
                arrows: false,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
                responsive: [{
                        breakpoint: 1199,
                        settings: {
                            arrows: false,
                            slidesToShow: 2,
                            dots: false,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        })(jQuery);
    </script>
@endpush
