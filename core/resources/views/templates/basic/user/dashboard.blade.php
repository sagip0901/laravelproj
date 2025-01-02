@extends('Template::layouts.master')
@section('content')
    @if ($user->kv != 1)
        @php
            $kyc = getContent('kyc_content.content', true);
        @endphp
        <div class="row">
            <div class="col-md-12">
                @if ($user->kv == 0)
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">@lang('KYC Verification required')</h4>
                        <hr>
                        <p class="mb-0">{{ __(@$kyc->data_values->kyc_verification) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                    </div>
                @elseif($user->kv == 2)
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">@lang('KYC Verification pending')</h4>
                        <hr>
                        <p class="mb-0">{{ __(@$kyc->data_values->kyc_pending) }} <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="dashboard-top mb-4">
                <div class="row  gy-4 justify-content-center">
                    <div class="col-md-6">
                        <div class="dashboard-top-robot">
                            <div class="dashboard-top-robot__thumb">
                                <img src="{{ asset($activeTemplateTrue . 'user/images/robot.png') }}" alt="@lang('image')">
                            </div>
                            <h4 class="robot-name"><span id="element" style="opacity: 1"><span class="text-dark">@lang('Hi')!,</span> {{ $user->username }}</span></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if (@$user->balanceLimit['plan'])
                            <div class="remaining-time">
                                <h4 class="remaining-time__title">@lang('Remaining Time') ...</h4>
                                <div class="remaining-time__content d-flex ">
                                    <p class="box __days"></p><span class="box-divider text-bold">:</span>
                                    <p class="box remaining-time__hrs"></p><span class="box-divider text-bold">:</span>
                                    <p class="box remaining-time__min"></p>
                                    <span class="box-divider text-bold text--danger">:</span>
                                    <p class="box remaining-time__sec text--danger"></p>
                                </div>
                            </div>
                        @else
                            <div class="dashboard-plan-generate">
                                <h4>@lang('Buy a Plan and Generate Your AI Content Now')</h4>
                                <a href="{{ route('plan') }}">@lang('Click here to buy a plan') <i class="las la-angle-right"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="dashboard-overview">
                <div class="dashboard-overview__header">
                    <h4>@lang('Overview') <i class="las la-camera"></i></h4>
                    <img class="robot-img" src="{{ asset($activeTemplateTrue . 'user/images/robot.png') }}" alt="@lang('image')">
                </div>
                <div class="dashboard-overview-file">
                    <div class="dashboard-file-item">
                        <div class="dashboard-file-item-single">
                            <p>@lang('Text Limit')</p>
                            <h4 class="text--warning">{{ @$user->balanceLimit['word_limit'] }}</h4>
                        </div>
                        <div class="dashboard-file-item-single">
                            <p>@lang('Image Limit')</p>
                            <h4 class="text--base">{{ @$user->balanceLimit['image_limit'] }}</h4>
                        </div>
                        <div class="dashboard-file-item-single">
                            <p>@lang('Minute Limit')</p>
                            <h4 class="text--primary">{{ @$user->balanceLimit['minute_limit'] }}</h4>
                        </div>
                    </div>
                    <div class="dashboard-overview-file-btn text-end">
                        <a class="btn btn--dark btn-sm" href="{{ route('user.template.list') }}">@lang('Generate Content')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-0 gy-4 mt-4">
        <div class="col-xl-4">
            <div class="subscribed-templete">
                <div class="subscribed-templete-header">
                    <h4>@lang('Subscribed Plan')</h4>
                </div>
                <div class="subscribed-templete-content">
                    @if (@$user->balanceLimit['plan'])
                        <div class="subscribed-templete-item">
                            <p class="templete-name">@lang('AI Template')</p>
                            @if (@$user->access->ai_template)
                                <span class="templete-action"><i class="las la-check"></i></span>
                            @else
                                <span class="templete-action-danger"><i class="las la-times"></i></span>
                            @endif
                            </span>
                        </div>
                        <div class="subscribed-templete-item">
                            <p class="templete-name">@lang('AI Image')</p>

                            @if (@$user->access->ai_image)
                                <span class="templete-action"><i class="las la-check"></i></span>
                            @else
                                <span class="templete-action-danger"><i class="las la-times"></i></span>
                            @endif
                            </span>
                        </div>
                        <div class="subscribed-templete-item">
                            <p class="templete-name">@lang('AI Code')</p>

                            @if (@$user->access->ai_code)
                                <span class="templete-action"><i class="las la-check"></i></span>
                            @else
                                <span class="templete-action-danger"><i class="las la-times"></i></span>
                            @endif
                            </span>
                        </div>
                        <div class="subscribed-templete-item">
                            <p class="templete-name">@lang('AI Chat')</p>
                            @if (@$user->access->ai_chat)
                                <span class="templete-action"><i class="las la-check"></i></span>
                            @else
                                <span class="templete-action-danger"><i class="las la-times"></i></span>
                            @endif
                            </span>
                        </div>
                        <div class="subscribed-templete-item">
                            <p class="templete-name">@lang('Premium Template')</p>
                            @if (@$user->access->premium_template)
                                <span class="templete-action"><i class="las la-check"></i></span>
                            @else
                                <span class="templete-action-danger"><i class="las la-times"></i></span>
                            @endif
                        </div>
                        <div class="subscribed-templete-item">
                            <p class="templete-name">@lang('Premium Chat')</p>
                            @if (@$user->access->premium_chat)
                                <span class="templete-action"><i class="las la-check"></i></span>
                            @else
                                <span class="templete-action-danger"><i class="las la-times"></i></span>
                            @endif
                        </div>
                    @else
                        <div class="p-4">
                            <div class="empty-template">
                                <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                                <p>@lang('No plan subscribed yet!')</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="subscribed-templete">
                <div class="subscribed-templete-header">
                    <h4>@lang('Favorite Templets') <i class="las la-star"></i></h4>
                </div>
                @forelse ($favoriteTemplates as $favorite)
                    <div class="subscribed-templete-content">
                        <div class="subscribed-templete-item style-two">
                            <div class="templete-social">
                                <span class="templete-social-icon">
                                    @php
                                        echo @$favorite->template->icon;
                                    @endphp
                                </span>
                                <div class="templete-social-content">
                                    <h6>{{ __(@$favorite->template->name) }}</h6>
                                    <p>{{ __(strLimit(@$favorite->template->description, 30)) }}</p>
                                </div>
                            </div>
                            <div class="subscribe-templete-view">
                                <a href="{{ route('user.template.form', @$favorite->template->code) }}">
                                    @lang('view the content') <i class="las la-angle-right"></i>
                                    <span>{{ showDateTime($favorite->created_at) }}</span> </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4">
                        <div class="empty-template">
                            <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                            <p>@lang('No templates found yet!')</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="subscribed-templete">
                <div class="subscribed-templete-header">
                    <h4>@lang('Daily History') <i class="lar la-clock"></i></h4>
                </div>
                @forelse ($histories as $history)
                    <div class="subscribed-templete-content">
                        <div class="subscribed-templete-item style-3">
                            <div class="templete-social">
                                <div class="templete-social-content">
                                    <h6>{{ __(@$history->title) }}</h6>
                                    <p>{{ __(strLimit(@$history->description, 40)) }}</p>
                                </div>
                            </div>
                            <div class="history-right d-flex justify-content-between align-items-center">
                                <div class="token-use">
                                    <h6>@lang('Token Use')</h6>
                                    <span>{{ getAmount(@$history->token) }} @lang('tokens')</span>
                                </div>
                                <div class="history-righ-view">
                                    <span>{{ showDateTime($history->created_at) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4">
                        <div class="empty-template">
                            <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                            <p>@lang('No history found yet!')</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    @php
        $welcomeMessage = getContent('welcome_message.element', orderById: true);
    @endphp

@endsection

@push('style')
    <style>
        .remaining-time {
            font-size: 24px;
            line-height: 1;
            max-width: fit-content;
            margin-left: auto;
        }

        .remaining-time__title {
            margin-bottom: 20px;
        }

        .remaining-time .box {
            width: 60px;
            height: 52px;
            border: 1px solid currentcolor;
            border-radius: 8px;
            padding: 0;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 600;
        }

        .remaining-time .box-divider {
            line-height: 42px;
            padding-inline: 10px;
            font-size: 34px;
            font-weight: 700
        }

        /* responsive  */
        @media screen and (max-width: 1099px) (min-width: 990px) {
            .remaining-time .box {
                width: 55px;
                font-size: 16px;
            }

            .remaining-time .box-divider {
                padding-inline: 5px;
            }
        }

        @media screen and (max-width: 768px) {
            .remaining-time {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 425px) {
            .remaining-time .box {
                width: 52px;
                height: 50px;
                font-size: 15px;
            }

            .remaining-time .box-divider {
                padding-inline: 4px;
            }
        }

        #element {
            transition: all linear 0.6s;
        }

        /* heading transiton */
    </style>
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'user/js/jquery.syotimer.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'user/js/syotimer.lang.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/typed.umd.js') }}"></script>
@endpush

@push('script')
    <script>
        const arr = [
            @foreach ($welcomeMessage as $message)
                '{{ $message->data_values->title }}',
            @endforeach
            '<span class="text-dark">@lang('Hi')!,</span> {{ $user->username }}',
        ]



        let index = 0;
        const arrLength = arr.length;
        var currentOpacity = 1;
        const opacityChangeFunc = () => {
            const text = $("#element");

            if (currentOpacity == 0) {
                currentOpacity = 1
                text.css("opacity", "1")

                if (index >= arrLength) {
                    index = 0;
                }
                text.html(arr[index]);
                text.css("transition-duration", "0.3s")
                index += 1;
            } else {
                currentOpacity = 0
                text.css("opacity", "0")
                text.css("transition-duration", "0.9s")
            }

            setTimeout(opacityChangeFunc, 1000);

        }
        opacityChangeFunc()




        let duration = "{{ @$user->expired_date }}"
        if (duration) {
            const targetDate = new Date(duration).getTime();
            const interval = setInterval(function() {
                const currentDate = new Date().getTime();
                const remainingTime = targetDate - currentDate;
                if (remainingTime <= 0) {
                    clearInterval(interval);
                } else {
                    const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                    $('.__days').html(`${days}d`);
                    $('.remaining-time__hrs').html(`${hours}h`);
                    $('.remaining-time__min').html(`${minutes}m`);
                    $('.remaining-time__sec').html(`${seconds}s`);
                }
            }, 1000);
        }
    </script>
@endpush
