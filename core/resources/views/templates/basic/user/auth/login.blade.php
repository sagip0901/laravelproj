@extends('Template::layouts.frontend')
@section('content')
    @php
        $loginContent = getContent('login.content', true);
    @endphp

    <section class="account flex-wrap">
        <div class="account__left flex-center text-center">
            <img src="{{ getImage('assets/images/frontend/login/' . @$loginContent->data_values->image, '880x970') }}"
                 alt="logo">
        </div>
        <div class="account__right for-login flex-align">
            <div class="account__right-inner">
                <a class="account-form__logo" href="{{ route('home') }}"><img src="{{ siteLogo('dark') }}"
                         alt="@lang('image')"></a>
                <div class="account-form">
                    <h3 class="account-form__title">{{ __(@$loginContent->data_values->heading) }}</h3>
                    <p class="account-form__desc"> {{ __(@$loginContent->data_values->subheading) }} </p>
                    <form class="verify-gcaptcha" method="POST" action="{{ route('user.login') }}">
                        @csrf
                        @include('Template::partials.social_login')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form--label" for="email">@lang('Username or Email')</label>
                                    <input class="form--control" name="username" type="text"
                                           value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form--label">@lang('Password')</label>
                                    <input class="form--control" name="password" type="password" required>
                                </div>
                            </div>
                            <x-captcha />
                            <div class="col-12">
                                <div class="form-group py-2">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="form--check">
                                            <input class="form-check-input" id="remember" name="remember" type="checkbox"
                                                   {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">@lang('Remember Me') </label>
                                        </div>
                                        <a class="forgot-password text-decoration-underline fs-14 text-white"
                                           href="{{ route('user.password.request') }}">@lang('Forgot your password?')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit">@lang('Sign In')</button>
                                </div>
                            </div>
                            @if (gs('registration'))
                                <div class="col-12">
                                    <div class="have-account text-center">
                                        <p class="have-account__text fs-15">@lang('New around here? Create an account?')
                                            <a class="have-account__link text-decoration-underline text-white"
                                               href="{{ route('user.register') }}">
                                                @lang('Sign Up')
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('style')
    <style>
        .account-form__logo {
            display: block;
            text-align: center !important;
        }

        @media (min-width: 321px) {
            .account__right-inner {
                padding: 30px !important;
            }
        }
    </style>
@endpush
