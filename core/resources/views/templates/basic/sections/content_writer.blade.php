@php
    $writerContent = getContent('content_writer.content', true);
    $categories = App\Models\Category::active()
        ->with([
            'templates' => function ($query) {
                $query->active();
            },
        ])
        ->get();
@endphp

@if ($categories->count())
    <section class="ai-templates py-70">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-heading__title" s-break="-1">{{ __(@$writerContent->data_values->heading) }}</h2>
                <p class="section-heading__desc fs-18"> {{ __(@$writerContent->data_values->subheading) }}</p>
            </div>

            <div class="tab-wrapper text-center">
                <ul class="custom--tab nav nav-pills template-tabs" id="pills-tab" role="tablist">
                    @foreach ($categories as $category)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif"
                                    id="{{ slug(@$category->name) }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#{{ slug(@$category->name) }}" type="button" role="tab"
                                    aria-controls="{{ slug(@$category->name) }}"
                                    aria-selected="true">{{ __(@$category->name) }}</button>
                        </li>
                    @endforeach
                    <li class="outline-background"></li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                @foreach ($categories as $category)
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                         id="{{ slug(@$category->name) }}" role="tabpanel"
                         aria-labelledby="{{ slug(@$category->name) }}-tab" tabindex="0">
                        <div class="row d-flex justify-content-center gy-4">
                            @forelse ($category->templates as $template)
                                <div class="col-lg-4 col-sm-6 col-xsm-6">
                                    <div class="ai-template-item">
                                        <h5 class="ai-template-item__title flex-between gap-1">
                                            {{ __(@$template->name) }}
                                            <span class="ai-template-item__icon text--gradient">@php echo @$template->icon @endphp</span>
                                        </h5>
                                        <p class="ai-template-item__desc">
                                            {{ strLimit(__(@$template->description), 80) }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-4 col-sm-6 col-xsm-6">
                                    <div class="ai-template-item">
                                        <div class="empty-template">
                                            <img src="{{ getImage($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                                            <span>@lang('No templates yet')!</span>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @push('script')
        <script>
            (function($) {
                "use strict";
                $(".template-tabs button").on('click', function() {
                    var position = $(this).parent().position();
                    var width = $(this).parent().width();
                    $(".outline-background").css({
                        left: +position.left,
                        width: width
                    });
                });
                var actWidth = $(".template-tabs").find(".active").parent("li").width();
                var actPosition = $(".template-tabs .active").position();
                $(".outline-background").css({
                    left: +actPosition.left,
                    width: actWidth
                });

            })(jQuery)
        </script>
    @endpush
@endif
