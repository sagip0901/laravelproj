@php
    $footerContent = getContent('footer.content', true);
    $socialIcons = getContent('social_icon.element', orderById: true);
    $policyPages = getContent('policy_pages.element', false, null, true);
    $subscribeContent = getContent('subscribe.content', true);
    $contactElements = getContent('contact_us.element', orderById: true, limit: 4);
@endphp

{{-- ========================== subscription Section Start ========================= --}}
<section class="subscription py-140 section-bg">
    <img class="subscription__bg" src="{{ getImage($activeTemplateTrue . 'images/thumbs/subscription-bg.jpg') }}">
    <img class="subscription__arrow right" src="{{ getImage($activeTemplateTrue . 'images/thumbs/arrow-right.png') }}">
    <img class="subscription__arrow left" src="{{ getImage($activeTemplateTrue . 'images/thumbs/arrow-left.png') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="subscription-content">
                    <div class="subscription-content__inner">
                        <h2 class="subscription-content__title">{{ __(@$subscribeContent->data_values->heading) }}</h2>
                        <p class="subscription-content__desc">{{ __(@$subscribeContent->data_values->subheading) }} </p>
                        <form class="subscription-form call-to-action-form" action="#">
                            <input class="form--control pill" name="email" type="email" placeholder="@lang('Enter your email address')">
                            <button class="btn btn--base btn--md pill" type="submit">@lang('Subscribe')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ========================== subscription Section End ========================= --}}

<footer class="footer-area section-bg">
    <div class="py-70">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}"><img src="{{ siteLogo('dark') }}" alt="img"></a>
                        </div>
                        <p class="footer-item__desc"> {{ __(@$footerContent->data_values->short_description) }} </p>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Site Links')</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item">
                                <a class="footer-menu__link" href="{{ route('home') }}" aria-current="page">@lang('Home')</a>
                            </li>
                            @foreach ($page as $k => $data)
                                <li class="footer-menu__item"><a class="footer-menu__link" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
                            @endforeach
                            <li class="footer-menu__item">
                                <a class="footer-menu__link" href="{{ route('plan') }}">@lang('Plan & Pricing')</a>
                            </li>
                            <li class="footer-menu__item">
                                <a class="footer-menu__link" href="{{ route('contact') }}">@lang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Quick Links')</h5>
                        <ul class="footer-menu">
                            @foreach ($policyPages as $policy)
                                <li class="footer-menu__item"><a class="footer-menu__link" href="{{ route('policy.pages', ['slug' => slug($policy->slug)]) }}">
                                        {{ __(@$policy->data_values->title) }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Office Info')</h5>
                        <div class="info-item-wrapper flex-align mt-4 gap-4">
                            @foreach ($contactElements as $conatct)
                                <div class="info-item">
                                    <div class="flex-align mb-1 gap-2">
                                        <span class="info-item__icon text--gradient"> @php echo @$conatct->data_values->icon @endphp </span>
                                        <h5 class="info-item__title"> {{ __(@$conatct->data_values->title) }}
                                        </h5>
                                    </div>
                                    <a class="info-item__desc fs-17" href="javascript:void(0)"> {{ @$conatct->data_values->value }} </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="container">
            <div class="bottom-footer__inner flex-between gap-2 py-4">
                <p class="bottom-footer__text"> @lang('Copyright') &copy; {{ date('Y') }} <a class="text--base underline" href="{{ route('home') }}">{{ __(gs('site_name')) }}</a> @lang('All Rights Reserved') </p>
                <ul class="social-list">
                    @foreach ($socialIcons as $social)
                        <li class="social-list__item"><a class="social-list__link flex-center" href="{{ @$social->data_values->url }}" target="_blank"> @php echo $social->data_values->social_icon @endphp </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('submit', '.call-to-action-form', function(e) {
                e.preventDefault();
                var email = $('[name="email"]').val();
                if (!email) {
                    notify('error', 'Email field is required');
                } else {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        url: "{{ route('subscribe') }}",
                        method: "POST",
                        data: {
                            email: email
                        },
                        success: function(response) {
                            if (response.success) {
                                notify('success', response.success);
                            } else {
                                notify('error', response.error);
                            }
                            $('input[name="email"]').val('');
                        }
                    });
                }
            });
        })(jQuery);
    </script>
@endpush
