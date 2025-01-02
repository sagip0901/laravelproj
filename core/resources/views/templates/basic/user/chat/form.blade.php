@extends('Template::layouts.master')
@section('content')
    <div class="chatboard-chat-area mt-5">
        <div class="row flex-wrap-reverse">
            <div class="col-md-4">
                <div class="chatboard-chat-left">
                    <div class="chatboard-chat-left__search">
                        <div class="form-group">
                            <input class="form-control" type="text" name="search" placeholder="Search">
                        </div>
                    </div>
                    <ul class="chatboard-chat-left-item">
                        @forelse ($chatList as $list)
                            <li @if (@$list->id == @$chat->id) class="active" @endif>
                                <a href="{{ route('user.chat.form', [@$chatBot->code, @$list->id]) }}">
                                    <span class="icon"><i class="lab la-rocketchat"></i></span>
                                    <p class="chat-item">
                                        <span class="title">{{ strLimit(@$list->lastMessage->message, 40) }}</span>
                                        <span class="time">{{ showDateTime(@$list->lastMessage->created_at) }}</span>
                                    </p>
                                </a>
                            </li>
                        @empty
                            <li class ="emtpy">
                                <div class="empty-template py-3">
                                    <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                                    <p>@lang('No chat found')!</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                    <div class="chatboard-chat-left-bottom">
                        <a href="{{ route('user.chat.form', @$chatBot->code) }}" class="btn w-100 btn--base">
                            <i class="las la-plus"></i>
                            @lang('Generate New')
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="chat-box">
                    <div class="chat-box__thread" id="message">
                        @if ($conversations)
                            @include('Template::user.chat.message')
                        @endif
                    </div>
                    <div class="chat-box__footer">
                        <div class="chat-send-area">
                            <div class="chat-send-field">
                                <form action="" method="POST" class="send__msg" id="messageForm">
                                    <div class="input-group">
                                        <textarea type="text" id="chat-message-field" class="form--control" name="message" placeholder="@lang('Write Message')..."></textarea>
                                        <button type="submit" class="btn--base btn-sm chat-send-btn"><i class="las la-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .dot-typing {
            position: relative;
            left: -9999px;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #4582ff;
            color: #4582ff;
            box-shadow: 9984px 0 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            animation: dot-typing 1.5s infinite linear;
        }

        @keyframes dot-typing {
            0% {
                box-shadow: 9984px 0 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            }

            16.667% {
                box-shadow: 9984px -10px 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            }

            33.333% {
                box-shadow: 9984px 0 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            }

            50% {
                box-shadow: 9984px 0 0 0 #4582ff, 9999px -10px 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            }

            66.667% {
                box-shadow: 9984px 0 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            }

            83.333% {
                box-shadow: 9984px 0 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px -10px 0 0 #4582ff;
            }

            100% {
                box-shadow: 9984px 0 0 0 #4582ff, 9999px 0 0 0 #4582ff, 10014px 0 0 0 #4582ff;
            }
        }

        .chatboard-chat-left-item {
            height: 376px;
        }

        .chatboard-chat-left-item li:last-child {
            border: 0;
        }

        li.emtpy {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chatboard-chat-left-bottom {
            padding: 25px 20px;
            border-top: 1px solid #f3f3f3;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            let id = "{{ @$chat->id }}";

            function autoScroll() {
                $('#message').animate({
                    scrollTop: $('#message').get(0).scrollHeight
                }, 1500);
            }

            autoScroll();

            $("#messageForm").on('submit', function(e) {
                e.preventDefault();

                let code = "{{ $chatBot->code }}";
                let message = $('[name=message]').val();

                let data = {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    code: code,
                    message: message
                };

                $.ajax({
                    url: "{{ route('user.chat.store') }}",
                    method: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            $('.chat-send-btn').prop('disabled', false);
                            notify('error', response.error);
                        } else {
                            id = response.chat_id
                            $('#messageForm')[0].reset();
                            autoScroll();
                            $("#message").append(response.message);
                            setTimeout(() => {
                                generateResponse(id);
                            }, 500);
                        }
                    }
                });
            });

            function generateResponse(chatId) {
                let dotType = `<div class="dot-type">
                                    <div class="snippet" data-title="dot-typing">
                                        <div class="stage">
                                            <div class="dot-typing"></div>
                                        </div>
                                    </div>
                                </div>`;
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.chat.generate') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        chat_id: chatId,
                    },
                    beforeSend: function() {
                        $("#message").append(dotType);
                    },
                    success: function(response) {
                        $('.chat-send-btn').prop('disabled', false);
                        if (response.error) {
                            $("#message").find('.dot-type').remove();
                            notify('error', response.error);
                        } else {
                            $("#message").find('.dot-type').remove();
                            autoScroll();
                            $("#message").append(response.message);
                        }
                    }
                });
            }

            const searchInput = $("[name=search]");
            searchInput.on("input", function() {
                const searchTerm = searchInput.val().toLowerCase();
                $(".chatboard-chat-left-item li").each(function() {
                    const itemText = $(this).text().toLowerCase();
                    if (itemText.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

        })(jQuery)
    </script>
@endpush
