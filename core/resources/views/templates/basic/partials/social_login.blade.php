@php
    $text = request()->routeIs('user.register') ? 'Register' : 'Login';
@endphp
<ul class="social-auth">
    @if (@gs('socialite_credentials')->google->status == Status::ENABLE)
        <li class="social-auth-list">
            <a href="{{ route('user.social.login', 'google') }}" class="social-auth-link">
                <span class="google-icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/google.svg') }}" alt="Google">
                </span> @lang("$text with Google")
            </a>
        </li>
    @endif
    @if (@gs('socialite_credentials')->facebook->status == Status::ENABLE)
        <li class="social-auth-list">
            <a href="{{ route('user.social.login', 'facebook') }}" class="social-auth-link">
                <span class="facebook-icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/facebook.svg') }}" alt="Facebook">
                </span> @lang("$text with Facebook")
            </a>
        </li>
    @endif
    @if (@gs('socialite_credentials')->linkedin->status == Status::ENABLE)
        <li class="social-auth-list">
            <a href="{{ route('user.social.login', 'linkedin') }}" class="social-auth-link">
                <span class="facebook-icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/linkdin.svg') }}" alt="Linkedin">
                </span> @lang("$text with Linkedin")
            </a>
        </li>
    @endif

    @if (@gs('socialite_credentials')->linkedin->status || @gs('socialite_credentials')->facebook->status == Status::ENABLE || @gs('socialite_credentials')->google->status == Status::ENABLE)
        <li class="auth-divide">
            <span>@lang('OR')</span>
        </li>
    @endif
</ul>
@push('style')
    <style>
        .social-auth {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .social-auth-link {
            border: 1px solid hsl(var(--white) / .2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: hsl(var(--white) / .8);
            font-size: 16px;
            padding: 10px 12px;
            border-radius: 8px;
        }

        .social-auth-link:hover {
            color: hsl(var(--white))
        }

        .auth-divide {
            margin: 16px 0;
            text-align: center;
            position: relative;
        }

        .auth-divide span {
            padding: 0px 6px;
            background: #081730;
            z-index: 1;
            position: relative;
        }

        .auth-divide::after {
            content: '';
            position: absolute;
            height: 1px;
            width: 100%;
            background-color: hsl(var(--white) / .2);
            left: 0;
            top: 50%;
        }
    </style>
@endpush
