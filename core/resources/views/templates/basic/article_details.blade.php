@extends('Template::layouts.frontend')
@section('content')
    <section class="blog-details pt-70 pb-140">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="blog-item">
                        <div class="blog-item__inner">
                            <div class="blog-item__thumb blog-details__thumb">
                                <img class="fit-image" src="{{ getImage('assets/images/frontend/article/' . $article->data_values->image, '900x855') }}" alt="@lang('image')">
                            </div>
                            <div class="blog-item__content">
                                <h3 class="blog-item__title"> {{ __($article->data_values->title) }} </h3>
                                <div class="blog__details">
                                    @php echo $article->data_values->description @endphp
                                </div>
                                <div class="blog-details__share flex-between gap-2">
                                    <h5 class="mb-0"> @lang('Share This Post') </h5>
                                    <ul class="social-list">
                                        <li class="social-list__item"><a class="social-list__link flex-center icon-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i
                                                   class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="social-list__item"><a class="social-list__link flex-center icon-twitter" href="https://twitter.com/intent/tweet?text={{ __($article->data_values->title) }}&amp;url={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="social-list__item"><a class="social-list__link flex-center icon-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __($article->data_values->title) }}&amp;summary={{ __($article->data_values->title) }}" target="_blank">
                                                <i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li class="social-list__item"><a class="social-list__link flex-center icon-google" href="https://plus.google.com/share?url={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fab fa-google"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h4 class="blog-sidebar__title"> @lang('Latest Blog') </h4>
                            @foreach ($latestArticles as $latestArticle)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a
                                           href="{{ route('article.details',$latestArticle->slug) }}">
                                            <img class="fit-image" src="{{ getImage('assets/images/frontend/article/thumb_' . $latestArticle->data_values->image, '300x285') }}" alt="@lang('image')">
                                        </a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title"><a
                                               href="{{ route('article.details',$latestArticle->slug) }}">
                                                {{ __($latestArticle->data_values->title) }} </a></h6>
                                        <div class="blog-meta flex-align">
                                            <div class="blog-meta__item">
                                                <span class="icon text--gradient"><i
                                                       class="fas fa-calendar-check"></i></span>
                                                <span class="text"> {{ __($latestArticle->created_at->format('d m y')) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
