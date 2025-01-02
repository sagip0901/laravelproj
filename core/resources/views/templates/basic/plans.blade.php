@extends('Template::layouts.frontend')
@section('content')
    <section class="pricing pb-70">
        <div class="container">
            @include('Template::partials.plan_card')
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
