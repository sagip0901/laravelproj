@extends('Template::layouts.master')
@section('content')
    <div class="card referral-card">
        <div class="row gy-4">
            <div class="col-md-12">
                <form action="" id="generateImage" method="POST">
                    @csrf
                    <div class="referral-content generate-content">
                        <h4>@lang('Explain your idea'). | @lang('Generate Image with DALL-E')</h4>
                        <div class="generate">
                            <div class="input-group">
                                <input type="text" name="description" class="form--control" placeholder="@lang('image Description')">
                                <button class="generate-btn input-group-text" type="submit">@lang('Generate')</button>
                            </div>
                        </div>
                    </div>

                    <div class="advance-setting d-flex flex-wrap align-items-center gap-2 justify-content-between mt-3">
                        <div class="advance-setting-left">
                            <a href="javascript:void(0)" class="advanceBtn">@lang('Advanced Settings') <span><i class="las la-plus"></i></span></a>
                        </div>
                        <div class="advance-setting-right">
                            <ul class="advance-list">
                                <li>@lang('Word') : <span>{{ @$user->balanceLimit['word_limit'] }}</span></li>
                                <li>@lang('Image') : <span>{{ @$user->balanceLimit['image_limit'] }}</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="advance-generate-form mt-4">
                        <div class="row">
                            <div class="col-xl-3  col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">@lang('Artist')</label>
                                    <select class="form--select form--control" name="artist">
                                        @foreach ($artists as $artist)
                                            <option value="{{ $artist }}">{{ $artist }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3  col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">@lang('Resolution')</label>
                                    <select class="form--select form--control" name="resolution">
                                        <option value="256x256">256 x 256 @lang('px')</option>
                                        <option value="512x512">512 x 512 @lang('px')</option>
                                        <option value="1024x1024">1024 x 1024 @lang('px')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3  col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">@lang('Number of Image')</label>
                                    <select class="form--select form--control" name="amount">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3  col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">@lang('Image Name (optional)')</label>
                                    <input type="text" class="form--control" name="name">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="generator-image-wrapper mt-5">
        @if(!blank($data))
        <div class="row d-flex justify-content-center gy-4 image-result-area">
            @foreach ($data as $item)
                <div class="col-md-3 col-sm-4 col-6">
                    <div class="generator-image__item">
                        <div class="generator-image__item-img" style="background-image: url({{ getImage(getFilePath('ai_image') . '/' . $item->image) }})">
                            <div class="generator-image__view">
                                <ul>
                                    <li><a href="{{ route('user.image.download', $item->id) }}"><i class="las la-arrow-circle-down"></i></a></li>
                                    <li><a href="{{ route('user.image.remove', $item->id) }}"><i class="las la-times"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <p>{{ __(@$item->name) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="row d-flex justify-content-center gy-4 image-result-area">
        </div>
        <div class="card empty-card">
            <div class="card-body">
                <div class="empty-template">
                    <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                    <p>@lang('No image generated yet!')</p>
                </div>
            </div>
        </div>
        @endif
        
    </div>

    <x-confirmation-modal />
@endsection

@push('style')
    <style>
        .skeleton {
            height: 210px;
            animation: skeleton-loading 1s linear infinite alternate;
        }

        @keyframes skeleton-loading {
            0% {
                background-color: hsl(0, 4%, 86%);
            }

            100% {
                background-color: hsl(0, 0%, 93%);
            }
        }

        .skeleton-text {
            width: 100%;
            height: 0.7rem;
            margin-bottom: 0.5rem;
            border-radius: 0.25rem;
        }

        .advance-generate-form {
            display: none;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.advanceBtn').on('click', function(e) {
                $(".advance-generate-form").toggle();
            });

            function sckeleton() {
                let sckeleton = `<div class="col-md-4 ">
                                        <div class="single-image-preview skeleton">
                                            <p class="skeleton-text"></p>
                                        </div>
                                    </div>`;
            }

            $('#generateImage').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let url = "{{ route('user.image.generate') }}";
                let processBtn = `<span class="processing"><i class="las la-spinner"></i> @lang('Processing')</span>`;
                let skeleton = ``;
                let amount = $('[name=amount]').val();
                for (let index = 0; index < amount; index++) {
                    skeleton += `<div class="col-md-3 col-sm-4 col-6">
                                    <div class="generator-image__item skeleton">
                                        <div class="generator-image__item-img">
                                            <div class="generator-image__view ">
                                            </div>
                                        </div>
                                        <p class="skeleton-text"></p>
                                    </div>
                                </div>`;
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    beforeSend: function() {
                        $('.empty-card').addClass('d-none');
                        $('.generate-btn').html(processBtn);
                        $('.generate-btn').prop('disabled', true);
                        $('.empty-image').addClass('d-none');
                        $(".image-result-area").prepend(skeleton);
                    },
                    success: function(response) {
                        $(document).find('.skeleton').closest('.col-md-3').remove();
                        if (response.error) {
                            $('.empty-card').removeClass('d-none');
                            notify('error', response.error);
                            $('.generate-btn').html('');
                            $('.generate-btn').html('Generate');
                            $('.generate-btn').prop('disabled', false);
                            $('.empty-image').removeClass('d-none');
                            return;
                        }
                        $('.generate-btn').html('');
                        $('.generate-btn').html('Generate');
                        $('.generate-btn').prop('disabled', false);

                        $('.download-btn').prop('disabled', false);
                        $('.download-btn').attr('href', `{{ route('user.image.download', '') }}/${response.item_id}`);
                        $(".image-result-area").prepend(response.html);
                    }
                });
            });
        })(jQuery)
    </script>
@endpush
