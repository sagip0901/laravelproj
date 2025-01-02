@php
    $user = auth()->user();
@endphp

<div class="dashboard-top-nav">
    <div class="row align-items-center">
        <div class="col-2 col-sm-4 d-lg-block d-none">
            <h5 class="page-title">{{ __($pageTitle) }}</h5>
        </div>
        <div class="col-2 col-sm-4 d-lg-none d-block">
            <button class="sidebar-open-btn"><i class="las la-bars"></i></button>
        </div>
        <div class="col-10 col-sm-8">
            <div class="d-flex flex-wrap justify-content-end align-items-center">
                <ul class="header-top-menu">
                    <li class="m-0">
                        <a href="{{ route('plan') }}" class="btn btn--base btn-sm">
                            <i class="las la-certificate"></i>
                            @lang('Upgrade Plan')
                        </a>
                    </li>
                </ul>
                <div class="header-user">
                    <a href="{{ route('user.logout') }}" class="btn btn--dark btn-sm">
                        <i class="las la-sign-out-alt"></i>
                        @lang('Logout')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
