@extends('Template::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="template-wrapper">
                <ul class="nav ai-templat-tabs nav-tabs" id="myTab" role="tablist">
                    @foreach ($categories as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif" id="{{ slug(@$category->name) }}" data-bs-toggle="tab" data-bs-target="#{{ slug(@$category->name) }}-pane" type="button" role="tab" aria-controls="{{ slug(@$category->name) }}-pane"
                                aria-selected="true">{{ __(@$category->name) }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content ai-template-card" id="myTabContent">
                    @foreach ($categories as $category)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ slug(@$category->name) }}-pane" role="tabpanel" aria-labelledby="{{ slug(@$category->name) }}" tabindex="0">
                            <div class="d-flex flex-wrap mt-4">
                                @forelse ($category->templates as $template)
                                    <div class="template">
                                        @if (in_array($template->id, $user->favoriteTemplateIds))
                                            <button class="fev-icon favoriteBtn active" data-template_id="{{ $template->id }}"><i class="las la-star"></i></button>
                                        @else
                                            <button class="fev-icon favoriteBtn" data-template_id="{{ $template->id }}"><i class="lar la-star"></i></button>
                                        @endif

                                        @if (!$template->is_free)
                                            <button class="premium"><i class="fas fa-crown"></i></button>
                                        @endif

                                        <a href="{{ route('user.template.form', $template->code) }}">
                                            <span class="template-card-icon">@php echo @$template->icon @endphp</span>
                                            <h4 class="template-card-title">{{ __(@$template->name) }}</h4>
                                            <p class="template-card-subtitle">{{ strLimit(__(@$template->description), 40) }}</p>
                                        </a>
                                    </div>
                                @empty
                                    <div class="empty-template w-100">
                                        <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                                        <p>@lang('No templates yet!')</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
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
                                $(document).find(`[data-template_id='${response.templateId}']`).removeClass('active');
                                $(document).find(`[data-template_id='${response.templateId}'] i`).removeClass('las');
                                $(document).find(`[data-template_id='${response.templateId}'] i`).addClass('lar');
                            } else {
                                $(document).find(`[data-template_id='${response.templateId}']`).addClass('active');
                                $(document).find(`[data-template_id='${response.templateId}'] i`).removeClass('lar');
                                $(document).find(`[data-template_id='${response.templateId}'] i`).addClass('las');
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
