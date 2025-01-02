<div class="d-sidebar h-100 rounded">
    <button class="sidebar-close-btn bg--base text-white"><i class="las la-times"></i></button>
    <div class="d-sidebar__thumb">
        <a href="{{ route('home') }}">
            <img src="{{ siteLogo() }}" alt="@lang('logo')">
        </a>
    </div>
    <div class="sidebar-menu-wrapper" id="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="sidebar-menu__item {{ menuActive('user.home') }}">
                <a class="sidebar-menu__link" href="{{ route('user.home') }}">
                    <i class="las la-home"></i>
                    @lang('Dashboard')
                </a>
            </li>
            <li class="sidebar-menu__item {{ menuActive('user.template.*') }}">
                <a class="sidebar-menu__link" href="{{ route('user.template.index') }}">
                    <i class="las la-marker"></i>
                    @lang('Content Writer')
                </a>
            </li>
            <li class="sidebar-menu__item {{ menuActive('user.image.list') }}">
                <a class="sidebar-menu__link" href="{{ route('user.image.list') }}">
                    <i class="las la-images"></i>
                    @lang('Image Generator')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.code.*') }}">
                <a class="sidebar-menu__link" href="{{ route('user.code.list') }}">
                    <i class="las la-code"></i>
                    @lang('Code Assistance')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.chat.*') }}">
                <a class="sidebar-menu__link" href="{{ route('user.chat.index') }}">
                    <i class="lab la-rocketchat"></i>
                    @lang('Virtual Chat')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.seo.*') }}">
                <a class="sidebar-menu__link" href="{{ route('user.seo.index') }}">
                    <i class="las la-cogs"></i>
                    @lang('SEO Generate')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.translate.*') }}">
                <a class="sidebar-menu__link" href="{{ route('user.translate.index') }}">
                    <i class="las la-language"></i>
                    @lang('Translator')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.transcript.form') }}">
                <a class="sidebar-menu__link" href="{{ route('user.transcript.form') }}">
                    <i class="las la-file-audio"></i>
                    @lang('Speech To Text')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.task.counter') }}">
                <a class="sidebar-menu__link" href="{{ route('user.task.counter') }}">
                    <i class="las la-spell-check"></i>
                    @lang('Character Counter')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.task.letter.togglize') }}">
                <a class="sidebar-menu__link" href="{{ route('user.task.letter.togglize') }}">
                    <i class="las la-font"></i>
                    @lang('Text Transform')
                </a>
            </li>
            <li class="sidebar-menu__item {{ menuActive('user.task.archive') }}">
                <a class="sidebar-menu__link" href="{{ route('user.task.archive') }}">
                    <i class="las la-archive"></i>
                    @lang('Archives Data')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.finalcial.advisor') }}">
                <a class="sidebar-menu__link" href="{{ route('user.finalcial.advisor') }}">
                    <i class="las la-user-tie"></i>
                    @lang('Financial Advisor')
                </a>
            </li>

            @if (gs('weather'))
                <li class="sidebar-menu__item {{ menuActive('user.weather.index') }}">
                    <a class="sidebar-menu__link" href="{{ route('user.weather.index') }}">
                        <i class="las la-wind"></i>
                        @lang('Weather Forecast')
                    </a>
                </li>
            @endif

            <li class="sidebar-menu__item {{ menuActive('user.referrals') }}">
                <a class="sidebar-menu__link" href="{{ route('user.referrals') }}">
                    <i class="las la-user-friends"></i>
                    @lang('Referral')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.deposit.history') }}">
                <a class="sidebar-menu__link" href="{{ route('user.deposit.history') }}">
                    <i class="las la-wallet"></i>
                    @lang('Payment Log')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.withdraw.history') }}">
                <a class="sidebar-menu__link" href="{{ route('user.withdraw.history') }}">
                    <i class="las la-hand-holding-usd"></i>
                    @lang('Withdraw Log')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.transactions') }}">
                <a class="sidebar-menu__link" href="{{ route('user.transactions') }}">
                    <i class="las la-exchange-alt"></i>
                    @lang('Transactions')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('ticket.*') }}">
                <a class="sidebar-menu__link" href="{{ route('ticket.index') }}">
                    <i class="las la-ticket-alt"></i>
                    @lang('Support Ticket')
                </a>
            </li>

            <li class="sidebar-menu__item {{ menuActive('user.profile.setting') }}">
                <a class="sidebar-menu__link" href="{{ route('user.profile.setting') }}">
                    <i class="las la-cogs"></i>
                    @lang('Setting')
                </a>
            </li>
        </ul>

        <div class="user-profile">
            <div class="user-profile-info">
                <div class="user-profile-info__icon">
                    <i class="las la-user"></i>
                </div>
                <div class="user-profile-info__content">
                    <h6 class="user-profile-info__name"><span>@</span>{{ auth()->user()->username }}</h6>
                    <p class="user-profile-info__desc">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <button class="user-profile-dots dropdown-toggle" id="exportMenuButton" data-bs-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="exportMenuButton">
                <a class="dropdown-item" href="{{ route('user.profile.setting') }}">
                    <i class="las la-cogs"></i> @lang('Setting')
                </a>
                <a class="dropdown-item" href="{{ route('user.logout') }}">
                    <i class="las la-sign-out-alt"></i> @lang('Logout')
                </a>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        'use strict';
        (function($) {
            const sidebar = document.querySelector('.d-sidebar');
            const sidebarOpenBtn = document.querySelector('.sidebar-open-btn');
            const sidebarCloseBtn = document.querySelector('.sidebar-close-btn');

            sidebarOpenBtn.addEventListener('click', function() {
                sidebar.classList.add('active');
            });
            sidebarCloseBtn.addEventListener('click', function() {
                sidebar.classList.remove('active');
            });


            $(function() {
                $('#sidebar-menu-wrapper').slimScroll({
                    height: '93vh'
                });
            });

            $('.sidebar-dropdown > a').on('click', function() {
                if ($(this).parent().find('.sidebar-submenu').length) {
                    if ($(this).parent().find('.sidebar-submenu').first().is(':visible')) {
                        $(this).find('.side-menu__sub-icon').removeClass('transform rotate-180');
                        $(this).removeClass('side-menu--open');
                        $(this).parent().find('.sidebar-submenu').first().slideUp({
                            done: function done() {
                                $(this).removeClass('sidebar-submenu__open');
                            }
                        });
                    } else {
                        $(this).find('.side-menu__sub-icon').addClass('transform rotate-180');
                        $(this).addClass('side-menu--open');
                        $(this).parent().find('.sidebar-submenu').first().slideDown({
                            done: function done() {
                                $(this).addClass('sidebar-submenu__open');
                            }
                        });
                    }
                }
            });
        })(jQuery);
    </script>
@endpush
