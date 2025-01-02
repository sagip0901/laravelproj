@extends('Template::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header flex-wrap gap-3">
            <h5>@lang('Generated SEO')</h5>
            <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                <a href="{{ route('user.seo.form') }}" class="btn btn--base btn-sm">
                    <i class="las la-plus"></i>
                    @lang('Generate New')
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @if (!blank($contents))
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('S.N.')</th>
                                <th>@lang('Word Used')</th>
                                <th>@lang('Created_at')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr>
                                    <td>{{ $contents->firstItem() + $loop->index }}</td>
                                    <td>{{ getAmount($content->token) }} @lang('Words')</td>
                                    <td>{{ showDateTime($content->created_at) }} </td>
                                    <td>
                                        <a class="btn btn--base btn-sm" href="{{ route('user.seo.download', $content->id) }}"><i class="las la-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5">
                    <div class="empty-template">
                        <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                        <p>@lang('No SEO generated yet!')</p>
                    </div>
                </div>
            @endif
        </div>
        @if ($contents->hasPages())
            <div class="card-footer">
                {{ paginatelinks($contents) }}
            </div>
        @endif
    </div>
@endsection
