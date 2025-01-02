@extends('Template::layouts.frontend')
@section('content')
    <section class="blog pt-70 pb-140">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @foreach ($articles as $articleElement)
                    <div class="col-lg-3 col-sm-6 col-xsm-6">
                        <div class="blog-item">
                            <div class="blog-item__inner">
                                <div class="blog-item__thumb">
                                    <a class="blog-item__thumb-link"
                                       href="{{ route('article.details', $articleElement->slug) }}">
                                        <img class="fit-image" src="{{ frontendImage('article', 'thumb_' . $articleElement->data_values->image, '300x285') }}" alt="blog image">
                                    </a>
                                </div>
                                <div class="blog-item__content">
                                    <h5 class="blog-item__title">
                                        <a class="blog-item__title-link border-effect" href="{{ route('article.details', $articleElement->slug) }}">
                                            {{ __($articleElement->data_values->title) }}
                                        </a>
                                    </h5>
                                    <a class="btn--simple fs-13 text-white" href="{{ route('article.details', $articleElement->slug) }}">
                                        @lang('Read More') <span class="icon"><i class="las la-angle-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($articles->hasPages())
                <div class="paginate">
                    {{ paginateLinks($articles) }}
                </div>
            @endif
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
