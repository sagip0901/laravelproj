@extends('Template::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="d-flex flex-wrap mt-4">
            @forelse ($chatBots as $chatBot)
                <div class="chatboard-bot">
                    @if (!@$chatBot->is_free)
                        <button class="premium"><i class="fas fa-crown"></i></button>
                    @endif
                    <a href="{{ route('user.chat.form', $chatBot->code) }}">
                        <img src="{{ getImage(getFilePath('chat_bot') . '/' . $chatBot->image) }}" alt="@lang('image')">
                        <h6>{{ __(@$chatBot->name) }}</h6>
                        <p>{{ __($chatBot->designation) }}</p>
                    </a>
                </div>
            @empty
                <div class="chatboard-bot">
                    @lang('No chat bot yet!')
                </div>
            @endforelse
        </div>
    </div>
@endsection
