@extends('Template::layouts.frontend')
@section('content')
    @php
        $contactContent = getContent('contact_us.content', true);
        $contactElements = getContent('contact_us.element', orderById: true, limit: 3);
    @endphp

    <section class="contact-cards py-70">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-1"> {{ __(@$contactContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18">{{ __(@$contactContent->data_values->subheading) }}</p>
        </div>
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @foreach ($contactElements as $contactElement)
                    <div class="col-lg-4 col-sm-6 col-xsm-6">
                        <div class="contact-card flex-align">
                            <span class="contact-card__icon flex-center"> <span
                                      class="text--gradient">@php echo $contactElement->data_values->icon; @endphp</span> </span>
                            <div class="contact-card__content">
                                <h4 class="contact-card__title">{{ __($contactElement->data_values->title) }}</h4>
                                <p class="contact-card__desc fs-15">{{ __($contactElement->data_values->value) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="contact-form-wrapper pt-70 pb-140">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-7">
                    <div class="contact-form">
                        <form class="verify-gcaptcha" method="post" action="">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-xsm-6">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Name')</label>
                                        <input class="form--control" name="name" type="text"
                                               value="{{ old('name', @$user->fullname) }}"
                                               @if ($user) readonly @endif required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xsm-6">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Email')</label>
                                        <input class="form--control" name="email" type="email"
                                               value="{{ old('email', @$user->email) }}"
                                               @if ($user) readonly @endif required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Subject')</label>
                                        <input class="form--control" name="subject" type="text"
                                               value="{{ old('subject') }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Message')</label>
                                        <textarea class="form--control" name="message" wrap="off" required>{{ old('message') }}</textarea>
                                    </div>
                                    <x-captcha />
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0 mt-2">
                                        <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-map">
                        <iframe src="{{ @$contactContent->data_values->google_map }}" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
