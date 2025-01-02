@extends('Template::layouts.frontend')
@section('content')
    <div class="pb-70">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
                            <h5 class="mb-0">@lang('Verify Your Email')</h5>
                            <a href="{{ route('user.logout') }}" class="btn btn--base btn--sm">@lang('Logout')</a>
                        </div>
                        <form class="submit-form" action="{{ route('user.verify.email') }}" method="POST">
                            @csrf
                            <p class="py-3">@lang('A 6 digit verification code sent to your email address'): {{ showEmailAddress(auth()->user()->email) }}</p>
                            @include('Template::partials.verification_code')
                            <div class="mb-3">
                                <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                            </div>
                            <div class="mb-3">
                                <p>
                                    <span>@lang('If you don\'t get any code')</span>, <span class="countdown-wrapper">@lang('try again after') <span id="countdown" class="fw-bold">--</span> @lang('seconds')</span> <a href="{{ route('user.send.verify.code', 'email') }}" class="try-again-link d-none text--base"> @lang('Try again')</a>
                                </p>
                                @if ($errors->has('resend'))
                                    <small class="text--danger d-block">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .verification-code::after {
            display: none;
        }

        .cursor-color {
            caret-color: transparent;
        }

        .verification-code-wrapper {
            background-color: transparent;
            border: 1px solid #6f6f6f66;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('#verification-code').on('input', function() {
                var inputLength = $(this).val().length;
                if (inputLength == 6) {
                    $(this).addClass('cursor-color');
                } else {
                    $(this).removeClass('cursor-color');
                }
            });
        })(jQuery)
    </script>
@endpush
@push('script')
    <script>
        var distance = Number("{{ @$user->ver_code_send_at->addMinutes(2)->timestamp - time() }}");
        var x = setInterval(function() {
            distance--;
            document.getElementById("countdown").innerHTML = distance;
            if (distance <= 0) {
                clearInterval(x);
                document.querySelector('.countdown-wrapper').classList.add('d-none');
                document.querySelector('.try-again-link').classList.remove('d-none');
            }
        }, 1000);
    </script>
@endpush
