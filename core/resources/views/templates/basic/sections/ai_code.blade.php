@php
    $codeContent = getContent('ai_code.content', true);
@endphp

<section class="ai-code py-70">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-7 pe-xl-5">
                <div class="ai-code__content pe-xxl-5">
                    <div class="section-heading style-left">
                        <h2 class="section-heading__title" s-break="-2">{{ __(@$codeContent->data_values->heading) }}</h2>
                        <p class="section-heading__desc fs-18">@php echo @$codeContent->data_values->description @endphp</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="ai-code__thumb">
                    <img src="{{ frontendImage('ai_code', @$codeContent->data_values->image, '525x565') }}" alt="@lang('image')" class="fit-image">
                </div>
            </div>
        </div>
    </div>
</section>
