@php
    $plans = App\Models\Plan::active()
        ->orderBy('id', 'desc')
        ->get()
        ->groupBy('type')
        ->mapWithKeys(function ($plans, $type) {
            $type = titleToKey($plans->first()->planTypeData());
            return [$type => $plans];
        });
@endphp

@if (!blank($plans))
    <div class="tab-wrapper text-center">
        <ul class="custom--tab nav nav-pills pricing-tabs" id="pills-tabsss" role="tablist">
            <li class="background"></li>
            @foreach ($plans as $key => $plan)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if ($loop->first) active @endif" id="{{ $key }}-tab"
                            data-bs-toggle="pill" data-bs-target="#{{ $key }}" type="button" role="tab"
                            aria-controls="{{ $key }}" aria-selected="true">{{ keyToTitle(@$key) }}</button>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" id="pills-tabsssContent">
        @foreach ($plans as $key => $plan)
            <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $key }}"
                 role="tabpanel" aria-labelledby="{{ $key }}-tab" tabindex="0">
                <div class="row gy-4 justify-content-center">
                    @foreach ($plan as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="pricing-item">
                                @if ($item->is_discount)
                                    <span class="discount-badge badge badge--info">@lang('Save')
                                        @php echo $item->discount @endphp</span>
                                @endif
                                <div class="pricing-item__inner">
                                    <div class="pricing-item__header flex-between gap-2">
                                        <h5 class="pricing-item__criteria mb-0">{{ __(@$item->name) }}</h5>
                                        <h4 class="pricing-item__price">
                                            {{ showAmount($item->price) }}
                                            <small class="fs-12 fw-normal">/ @php echo $item->planTypeBadge @endphp</small>
                                        </h4>
                                    </div>
                                    <div class="pricing-item__body">
                                        <ul class="text-list">
                                            <li class="text-list__item flex-align">
                                                @if ($item->ai_template)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                    <span class="text fs-15">{{ $item->wordLimitValue }}
                                                        @lang('Word Limit')</span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                    <span class="text fs-15">@lang('AI Template')</span>
                                                @endif
                                            </li>
                                            <li class="text-list__item flex-align">
                                                @if ($item->ai_image)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                    <span class="text fs-15">{{ $item->imageLimitValue }}
                                                        @lang('Image Limit')</span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                    <span class="text fs-15">@lang('AI Image ')</span>
                                                @endif
                                            </li>
                                            <li class="text-list__item flex-align">
                                                @if ($item->ai_chat)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                @endif
                                                <span class="text fs-15">@lang('AI Chat')</span>
                                            </li>
                                            <li class="text-list__item flex-align">
                                                @if ($item->ai_code)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                @endif
                                                <span class="text fs-15">@lang('AI Code')</span>
                                            </li>
                                            <li class="text-list__item flex-align">
                                                @if ($item->ai_transcript)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                    <span class="text fs-15">{{ $item->minuteLimitValue }}
                                                        @lang('Minutes Limit')</span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                    <span class="text fs-15">@lang('AI Speech to Text')</span>
                                                @endif
                                            </li>
                                            <li class="text-list__item flex-align">
                                                @if ($item->premium_template)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                @endif
                                                <span class="text fs-15">@lang('Premium Template')</span>
                                            </li>
                                            <li class="text-list__item flex-align">
                                                @if ($item->premium_chat)
                                                    <span class="icon"> <i
                                                           class="far la-check-circle text--success"></i></span>
                                                @else
                                                    <span class="icon"> <i
                                                           class="far la-times-circle text--danger"></i>
                                                    </span>
                                                @endif
                                                <span class="text fs-15">@lang('Premium Chat')</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="pricing-item__footer">
                                    @auth
                                        <button class="btn btn-outline--base pill w-100 subscribeBtn"
                                                data-action="{{ route('user.subscribe.plan', $item->id) }}"
                                                data-question="@lang('Are you sure to subscribe this plan')?" type="button">
                                            <span>@lang('Subscribe Now')</span>
                                        </button>
                                    @else
                                        <button class="btn btn-outline--base pill w-100 loginBtn" type="button">
                                            <span>@lang('Subscribe Now')</span>
                                        </button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endif

<div class="modal custom--modal fade" id="loginModal" role="dialog" aria-labelledby="existModalCenterTitle"
     aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existModalLongTitle">@lang('Confirmation Alert')!</h5>
                <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <h6 class="text-center mb-0">@lang('You need to login first')</h6>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark btn--sm" data-bs-dismiss="modal"
                        type="button">@lang('Close')</button>
                <a class="btn btn--base btn--sm" href="{{ route('user.login') }}">@lang('Login Now')</a>
            </div>
        </div>
    </div>
</div>

<div class="modal custom--modal fade" id="subscriptionModal" role="dialog" aria-labelledby="existModalCenterTitle"
     aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existModalLongTitle">@lang('Confirmation Alert')!</h5>
                <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <h6 class="text-center mb-0 question"></h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark btn--sm" data-bs-dismiss="modal"
                            type="button">@lang('No')</button>
                    <button class="btn btn--base btn--sm" type="submit">@lang('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-confirmation-modal />
@if (!blank($plans))
    @push('script')
        <script>
            (function($) {
                "use strict";
                $('.loginBtn').on('click', function(e) {
                    let modal = $("#loginModal");
                    modal.modal('show');
                });

                $('.subscribeBtn').on('click', function(e) {
                    let modal = $("#subscriptionModal");
                    modal.find('form').attr('action', $(this).data('action'))
                    modal.find('.question').text($(this).data('question'))
                    modal.modal('show');
                });

                $(".pricing-tabs button").click(function() {
                    var position = $(this).parent().position();
                    var width = $(this).parent().width();
                    $(".background").css({
                        left: +position.left,
                        width: width
                    });
                });

                var actWidth = $(".pricing-tabs").find(".active").parent("li").width();
                var actPosition = $(".pricing-tabs .active").position();
                $(".background").css({
                    "left": +actPosition.left,
                    "width": actWidth
                });
            })(jQuery)
        </script>
    @endpush
@endif
