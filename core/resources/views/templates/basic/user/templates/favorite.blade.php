@extends('Template::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex flex-wrap mt-4">
                @forelse ($favorites as $favorite)
                    <div class="template">
                        @if (in_array($favorite->template_id, $user->favoriteTemplateIds))
                            <button class="fev-icon favoriteBtn active" data-template_id="{{ $favorite->template_id }}"><i class="las la-star"></i></button>
                        @else
                            <button class="fev-icon favoriteBtn" data-template_id="{{ $favorite->template_id }}"><i class="lar la-star"></i></button>
                        @endif
                        @if (!@$favorite->template->is_free)
                            <button class="premium"><i class="fas fa-crown"></i></button>
                        @endif
                        <a href="{{ route('user.template.form', @$favorite->template->code) }}">
                            <span class="template-card-icon">@php echo @$favorite->template->icon @endphp</span>
                            <h4 class="template-card-title">{{ __(@$favorite->template->name) }}</h4>
                            <p class="template-card-subtitle">
                                {{ strLimit(__(@$favorite->template->description), 40) }}</p>
                        </a>
                    </div>
                @empty
                    <div class="card card-body">
                        <div class="empty-template">
                            <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                            <p>@lang('No favorite template found yet!')</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.favoriteBtn', function() {
                let url;
                if ($(this).hasClass('active')) {
                    url = `{{ route('user.template.favorite.remove') }}`;
                } else {
                    url = `{{ route('user.template.favorite.add') }}`;
                }
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    type: "POST",
                    url: url,
                    data: {
                        template_id: $(this).data('template_id')

                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.remark == 'remove') {
                                $(document).find(`[data-template_id='${response.templateId}']`)
                                    .removeClass('active');
                                $(document).find(`[data-template_id='${response.templateId}'] i`)
                                    .removeClass('las');
                                $(document).find(`[data-template_id='${response.templateId}'] i`)
                                    .addClass('lar');

                                $(document).find(`[data-template_id='${response.templateId}']`)
                                    .parent('.template').remove()
                            } else {
                                $(document).find(`[data-template_id='${response.templateId}']`)
                                    .addClass('active');
                                $(document).find(`[data-template_id='${response.templateId}'] i`)
                                    .removeClass('lar');
                                $(document).find(`[data-template_id='${response.templateId}'] i`)
                                    .addClass('las');
                            }
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    }
                });
            });
        })(jQuery)
    </script>
@endpush
