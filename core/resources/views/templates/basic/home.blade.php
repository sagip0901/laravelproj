@extends('Template::layouts.frontend')
@section('content')

    @include($activeTemplate . 'sections.banner')

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
