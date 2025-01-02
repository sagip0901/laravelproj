@extends('Template::layouts.frontend')
@section('content')
    <div class="pb-70">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <form action="{{ route('user.2fa.verify') }}" method="POST" class="submit-form">
                            @csrf

                            @include('Template::partials.verification_code')

                            <div class="form--group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
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
