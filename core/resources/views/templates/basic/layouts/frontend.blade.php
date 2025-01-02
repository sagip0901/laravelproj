@extends('Template::layouts.app')
@section('app')
    @php
        $page = App\Models\Page::where('tempname', $activeTemplate)
            ->where('is_default', Status::NO)
            ->get();
    @endphp

    @if (!request()->routeIs('user.login') && !request()->routeIs('user.register'))
        @include('Template::partials.header')
    @endif

    <main class="main">
        @if (!request()->routeIs('home') && !request()->routeIs('user.login') && !request()->routeIs('user.register'))
            @include('Template::partials.breadcrumb')
        @endif

        @yield('content')

        @if (!request()->routeIs('user.login') && !request()->routeIs('user.register'))
            @include('Template::partials.footer')
        @endif
    </main>
@endsection
