@php
    $articleContent = getContent('article.content', true);
    $articleElements = getContent('article.element', orderById: true, limit: 4);
@endphp
<section class="blog py-70">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title" s-break="-1">{{ __(@$articleContent->data_values->heading) }}</h2>
            <p class="section-heading__desc fs-18"> {{ __(@$articleContent->data_values->subheading) }} </p>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($articleElements as $articleElement)
                <div class="col-lg-3 col-sm-6 col-xsm-6">
                    <div class="blog-item">
                        <div class="blog-item__inner">
                            <div class="blog-item__thumb">
                                <a class="blog-item__thumb-link" href="{{ route('article.details', $articleElement->slug) }}">
                                    <img class="fit-image" src="{{ frontendImage('article', 'thumb_' . $articleElement->data_values->image, '300x285') }}" alt="article image">
                                </a>
                            </div>
                            <div class="blog-item__content">
                                <h5 class="blog-item__title"><a class="blog-item__title-link border-effect" href="{{ route('article.details', $articleElement->slug) }}"> {{ __(@$articleElement->data_values->title) }} </a></h5>
                                <a class="btn--simple text-white fs-13" href="{{ route('article.details', $articleElement->slug) }}"> @lang('Read More') <span class="icon"><i class="las la-angle-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
