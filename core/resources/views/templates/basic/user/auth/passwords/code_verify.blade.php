@extends('Template::layouts.frontend')
@section('content')
    <div class="pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-5">
                    <div class="d-flex justify-content-center">
                        <div class="verification-code-wrapper">
                            <div class="verification-area">
                                <p class="mb-2">@lang('A 6 digit verification code sent to your email address') : {{ showEmailAddress($email) }}</p>
                                <form class="submit-form" action="{{ route('user.password.verify.code') }}" method="POST">
                                    @csrf
                                    <input name="email" type="hidden" value="{{ $email }}">

                                    @include('Template::partials.verification_code')

                                    <div class="form-group">
                                        <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                                    </div>

                                    <p>@lang('Please check including your Junk/Spam Folder. if not found, you can')
                                        <a href="{{ route('user.password.request') }}"
                                            class="text--base">@lang('Try to send again')</a>
                                    </p>
                                </form>
                            </div>
                        </div>
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
