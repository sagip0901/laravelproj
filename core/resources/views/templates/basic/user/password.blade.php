@extends('Template::layouts.master', ['setting' => true])

@section('content')
    <div class="row justify-content-center gy-4">
        <div class="col-12">
            <div class="page-heading mb-4">
                <h3 class="mb-2">{{ __($pageTitle) }}</h3>
                <p>
                    @lang('Protect your account from unauthorized access and enhance your security by changing your password on our user-friendly password change page. Keep your information safe and secure with ease.')
                </p>
            </div>
            <hr>
        </div>

        <div class="col-lg-12">
            <div class="card style--two">
                <div class="card-body">
                    <form class="register" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">@lang('Current Password')</label>
                            <input type="password" class="form--control" name="current_password" required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">@lang('Password')</label>
                            <input type="password" class="form--control @if (gs('secure_password')) secure-password @endif" name="password" required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">@lang('Confirm Password')</label>
                            <input type="password" class="form--control" name="password_confirmation" required autocomplete="current-password">
                        </div>
                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (gs('secure_password'))
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
