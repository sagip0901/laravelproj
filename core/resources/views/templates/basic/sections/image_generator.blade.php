@php
    $imageGeneratorContent = getContent('image_generator.content', true);
@endphp

<section class="ai-images py-70">
    <div class="container">
        <div class="row gy-5 align-items-center flex-wrap-reverse">
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="ai-images-thumb">
                    <img src="{{ frontendImage('image_generator', @$imageGeneratorContent->data_values->image, '525x460') }}" alt="@lang('image')" class="fit-image">
                </div>
            </div>
            <div class="col-lg-7 ps-xl-5">
                <div class="ai-images__content ps-xxl-5">
                    <div class="section-heading style-left">
                        <h2 class="section-heading__title" s-break="-1">{{ __(@$imageGeneratorContent->data_values->heading) }}</h2>
                        <p class="section-heading__desc fs-18">@php echo @$imageGeneratorContent->data_values->description @endphp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
