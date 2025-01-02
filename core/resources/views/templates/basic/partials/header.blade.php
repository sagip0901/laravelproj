<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}"><img src="{{ siteLogo('dark') }}" alt=""></a>

            <div class="flex-align">
                @if (gs('multi_language'))
                    <div class="language-box d-lg-none d-block">
                        @include('Template::partials.language')
                    </div>
                @endif

                <button class="navbar-toggler header-button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="hiddenNav"><i class="las la-bars"></i></span>
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu align-items-lg-center ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('home') }}" href="{{ route('home') }}" aria-current="page">@lang('Home')</a>
                    </li>
                    @foreach ($page as $k => $data)
                        <li class="nav-item">
                            <a class="nav-link  @if ($data->slug == Request::segment(1)) active @endif" href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('plan') }}" href="{{ route('plan') }}">@lang('Plan & Pricing')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('article') }}" href="{{ route('article') }}">@lang('Article')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ menuActive('contact') }}" href="{{ route('contact') }}">@lang('Contact')</a>
                    </li>
                    <li class="flex-align pt-lg-0 ms-xxl-4 ms-lg-2 pt-3">
                        @if (gs('multi_language'))
                            <div class="language-box d-lg-block d-none">
                                @include('Template::partials.language')
                            </div>
                        @endif

                        @guest
                            <a class="btn btn-outline--base pill ms-1 header-btn" href="{{ route('user.login') }}">@lang('Sign In')</a>
                        @else
                            <a class="btn btn-outline--base pill ms-1 header-btn" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                        @endguest
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
