@extends('Template::layouts.master', ['setting' => true])

@section('content')
    <div class="row justify-content-center gy-4">

        <div class="col-12">
            <div class="page-heading mb-4">
                <h3 class="mb-2">{{ __($pageTitle) }}</h3>
                <p>
                    @lang('Personalize and keep your account up-to-date with our user-friendly profile page, allowing you to view and update your profile information easily. Manage your preferences and ensure that your account reflects your current details.')
                </p>
            </div>
            <hr>
        </div>

        <div class="col-xl-5 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-1">
                            <span class="fw--bold"><i class="las la-user base--color"></i> @lang('Username')</span>
                            <span>{{ @$user->username }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-1">
                            <span class="fw--bold"><i class="las la-envelope base--color"></i> @lang('Email')</span>
                            <span>{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-1">
                            <span class="fw--bold"><i class="las la-phone base--color"></i> @lang('Mobile')</span>
                            <span>{{ $user->mobile }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-1">
                            <span class="fw--bold"><i class="las la-globe base--color"></i> @lang('Country')</span>
                            <span>{{ @$user->country_name }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-6">
            <div class="card style--two">
                <div class="card-body">
                    <form class="register" action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">@lang('First Name')</label>
                                    <input type="text" class="form--control" name="firstname" value="{{ $user->firstname }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">@lang('Last Name')</label>
                                    <input type="text" class="form--control" name="lastname" value="{{ $user->lastname }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">@lang('Address')</label>
                                    <input type="text" class="form--control" name="address" value="{{ @$user->address }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">@lang('State')</label>
                                    <input type="text" class="form--control" name="state" value="{{ @$user->state }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form--control" name="zip" value="{{ @$user->zip }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">@lang('City')</label>
                                    <input type="text" class="form--control" name="city" value="{{ @$user->city }}">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
