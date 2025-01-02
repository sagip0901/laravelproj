@php
    $speechContent = getContent('speech_text.content', true);
@endphp

<section class="speech-text py-70">
    <div class="container">
        <div class="row gy-5 align-items-center flex-wrap-reverse">
            <div class="col-lg-5 col-md-8 col-sm-10">
                <div class="speech-text__thumb text-center">
                    <img src="{{ frontendImage('speech_text', @$speechContent->data_values->image, '525x565') }}" alt="@lang('image')">
                </div>
            </div>
            <div class="col-lg-7 ps-xl-5">
                <div class="speech-text__content">
                    <div class="section-heading style-left mb-0">
                        <h2 class="section-heading__title" s-break="-3">{{ __(@$speechContent->data_values->heading) }}</h2>
                        <p class="section-heading__desc fs-18">@php echo @$speechContent->data_values->description @endphp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
