@extends('Template::layouts.master')
@section('content')
    <div class="card referral-card">
        <form action="" method="GET">
            <div class="referral-content generate-content">
                <h4>@lang('Checkout today\'s weather information')</h4>
                <div class="generate">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request()->search }}" class="form--control" placeholder="@lang('Search by Location or IP')">
                        <button class="generate-btn input-group-text" type="submit">@lang('Search')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if ($weather && isset($weather->current))
        <div class="mt-4 weather-section">
            <div class="weather-section-top">
                <div class="row gy-4 align-items-center">
                    <div class="col-md-8">
                        <ul class="weather-list-group">
                            <li>
                                <p><i class="far fa-calendar-alt"></i> @lang('Today') {{ Carbon\Carbon::parse(@$weather->location->localtime)->format('d M') }}</p>
                                <p><i class="fas fa-map-marker-alt"></i> @lang('Location')</p>
                            </li>
                            <li>
                                <p> <i class="far fa-clock"></i> {{ Carbon\Carbon::parse(@$weather->location->localtime)->format('h:i') }}</p>
                                <p><i class="far fa-paper-plane"></i> {{ @$weather->location->name }} ,{{ @$weather->location->country }}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="temperature-amount">
                            <h6><span>{{ @$weather->current->temp_c }}</span><sup>&deg;</sup><span class="temperature">@lang('C')</span></h6>
                            <span class="temperature-title">{{ @$weather->current->condition->text }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Humidity')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-tint"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->humidity }}%
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Wind')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-wind"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->wind_kph }} @lang('km/h')
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Wind Degree')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-history"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->wind_degree }}&deg;
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Wind Direction')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-directions"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->wind_dir }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Cloud')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-cloud"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->cloud }}%
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Precipitation')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-snowflake"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->precip_in }} @lang('inch')
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('UV Index')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-cloud-showers-heavy"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->uv }} @lang('medium')
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-4 col-12">
                    <div class="weather-widget">
                        <div class="weather-widget__header">
                            <h6 class="weather-widget__title">
                                @lang('Feels Like')
                            </h6>
                            <div class="weather-widget__icon">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div class="weather-widget__footer">
                            <h6 class="weather-widge__value">
                                {{ @$weather->current->feelslike_c }}&deg;@lang('c')
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card empty-card mt-4 ">
            <div class="card-body">
                <div class="empty-template">
                    <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                    <p>@lang('No matching location found.')</p>
                </div>
            </div>
        </div>
    @endif
@endsection
