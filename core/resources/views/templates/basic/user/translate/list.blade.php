@extends('Template::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header flex-wrap gap-3">
            <h5>@lang('Generated Translate')</h5>
            <div class="d-flex flex-wrap justify-content-end align-items-center gap-3">
                <a href="{{ route('user.translate.index') }}" class="btn btn--base btn-sm">
                    <i class="las la-plus"></i>
                    @lang('Generate New')
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @if (!blank($translates))
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('S.N.')</th>
                                <th>@lang('Content')</th>
                                <th>@lang('Language')</th>
                                <th>@lang('Token Used')</th>
                                <th>@lang('Created_at')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($translates as $translate)
                                <tr>
                                    <td>{{ $translates->firstItem() + $loop->index }}</td>
                                    <td>{{ strLimit(@$translate->content, 40) }}</td>
                                    <td>{{ __($translate->language) }}</td>
                                    <td>{{ getAmount($translate->token) }} @lang('Words')</td>
                                    <td>{{ showDateTime($translate->created_at) }} </td>
                                    <td>
                                        <button type="button" class="btn btn--base btn-sm viewTranslate" data-content="{{ $translate->content }}" data-result="{{ $translate->result }}"><i class="las la-eye"></i></button>
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
                        <p>@lang('No translate generated yet!')</p>
                    </div>
                </div>
            @endif
        </div>
        @if ($translates->hasPages())
            <div class="card-footer">
                {{ paginatelinks($translates) }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="translateModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">@lang('Translate Data')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">@lang('Request Content')</h5>
                            <p class="request-content"></p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">@lang('Translated Content')</h5>
                            <p class="translate-content"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.viewTranslate').on('click', function(e) {
                let modal = $("#translateModal");
                modal.find('.request-content').text($(this).data('content'));
                modal.find('.translate-content').text($(this).data('result'));
                modal.modal('show')
            });
        })(jQuery)
    </script>
@endpush
