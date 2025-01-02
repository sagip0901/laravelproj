@php
    $textTransformContent = getContent('text_transform.content', true);
@endphp

<section class="ai-chat py-70">
    <div class="container">
        <div class="ai-chat__inner">
            <div class="row gy-5 align-items-center">
                <div class="col-xxl-5 col-lg-6">
                    <div class="ai-chat-thumb">
                        <img src="{{ frontendImage('text_transform', @$textTransformContent->data_values->image, '585x560') }}" alt="@lang('image')">
                    </div>
                </div>
                <div class="col-xxl-7 col-lg-6 ps-xl-5">
                    <div class="ai-chat__content">
                        <div class="section-heading style-left">
                            <h2 class="section-heading__title" s-break="-1">{{ __(@$textTransformContent->data_values->heading) }}</h2>
                            <p class="section-heading__desc fs-18">@php echo @$textTransformContent->data_values->description @endphp</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
