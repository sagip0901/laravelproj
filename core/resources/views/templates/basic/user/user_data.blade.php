@extends('Template::layouts.frontend')
@section('content')
    <div class="pb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="card custom--card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.data.submit') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Username')</label>
                                            <input class="form--control checkUser" name="username" type="text"
                                                   value="{{ old('username') }}" required>
                                            <small class="text--danger usernameExist"></small>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xsm-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang('Country')</label>
                                            <select class="form--control select2" name="country">
                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}"
                                                            data-code="{{ $key }}" value="{{ $country->country }}">
                                                        {{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xsm-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Mobile')</label>
                                            <div class="input-group input-with-text">
                                                <span class="input-group-text mobile-code"></span>
                                                <input name="mobile_code" type="hidden">
                                                <input name="country_code" type="hidden">
                                                <input class="form-control form--control checkUser" name="mobile"
                                                       type="number" value="{{ old('mobile') }}" required>
                                            </div>
                                            <small class="text--danger mobileExist"></small>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('Address')</label>
                                        <input type="text" class="form--control" name="address"
                                               value="{{ old('address') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('State')</label>
                                        <input type="text" class="form--control" name="state"
                                               value="{{ old('state') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('Zip Code')</label>
                                        <input type="text" class="form--control" name="zip"
                                               value="{{ old('zip') }}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('City')</label>
                                        <input type="text" class="form--control" name="city"
                                               value="{{ old('city') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn--base w-100">
                                    @lang('Submit')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .selection {
            display: block;
        }

        .select2-container:has(.select2-selection--single) {
            width: 100%;
            display: inline-block;
            position: relative;
        }

        .select2-container--default .select2-selection--single {
            height: 48px !important;
            background-color: hsl(var(--white) / 0.04) !important;
            border: 1px solid hsl(var(--white) / 0.1) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: hsl(var(--white)) !important;
            line-height: 48px;
            padding-inline: 24px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 12px !important;
        }

        .select2 .dropdown-wrapper {
            display: none;
        }

        .select2-dropdown {
            background-color: #302d4a;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: hsl(var(--white) / 0.04) !important;
            border: 1px solid hsl(var(--white) / 0.1) !important;
            color: white;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: hsl(var(--base)) !important;
            color: hsl(var(--white)) !important;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-results__option--selectable,
        .select2-container--default .select2-results__option--disabled {
            border-bottom: 1px solid hsl(var(--white) / 0.1) !important;
        }

        .select2-container--open .select2-selection.select2-selection--single,
        .select2-container--open .select2-selection.select2-selection--multiple,
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            border: 1px solid hsl(var(--white) / 0.2) !important;
        }
    </style>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush


@push('script')
    <script>
        "use strict";
        (function($) {

            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif
            $('.select2').select2();

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value, name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value, name);
            });

            function checkUser(value, name) {
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code: $('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush
