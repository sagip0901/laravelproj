@extends('Template::layouts.app')
@section('app')
    @php
        $banned = getContent('banned.content', true);
    @endphp
    <div class="maintenance-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-10 col-lg-12">
                    <div class="text-center">
                        <img src="{{ frontendImage('banned', @$banned->data_values->image, '360x370') }}" alt="@lang('image')" class="img-fluid mx-auto mb-5">
                        <h3 class="text--danger mb-2">{{ __(@$banned->data_values->heading) }}</h3>
                        <p class="mx-auto mb-4">{{ __($user->ban_reason) }} </p>
                        <a href="{{ route('home') }}" class="btn btn--base"> @lang('Go to Home') </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .maintenance-page {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush
