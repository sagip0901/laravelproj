@php
    $route = \Route::currentRouteName();
@endphp

<div class="row justify-content-center mb-4">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="settingTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($route == 'user.profile.setting') active @endif"
                   href="{{ route('user.profile.setting') }}" role="tab"
                   aria-selected="@if ($route == 'user.profile.setting') true @else false @endif">
                    @lang('Profile')
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($route == 'user.change.password') active @endif"
                   href="{{ route('user.change.password') }}"
                   aria-selected="@if ($route == 'user.change.password') true @else false @endif">
                    @lang('Change Password')
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($route == 'user.twofactor') active @endif" href="{{ route('user.twofactor') }}"
                   aria-selected="@if ($route == 'user.twofactor') true @else false @endif">
                    @lang('2FA Security')
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        border: none !important;
        font-weight: 700;
        color: #7e7e7e;
    }

    .nav-tabs .nav-link.active {
        color: #002046;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background: transparent;
    }
</style>
