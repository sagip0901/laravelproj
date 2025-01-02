@extends('Template::layouts.master')
@section('content')
    <div class="show-filter mb-3 text-end">
        <button type="button" class="btn btn--base showFilterBtn btn-sm"><i class="las la-filter"></i> @lang('Filter')</button>
    </div>
    <div class="responsive-filter-card transactions-form mb-4">
        <form action="">
            <div class="d-flex flex-wrap gap-3">
                <div class="flex-grow-1">
                    <label class="text-white">@lang('Transaction Number')</label>
                    <input type="text" name="search" value="{{ request()->search }}" class="form-control form--control">
                </div>
                <div class="flex-grow-1">
                    <label class="text-white">@lang('Type')</label>
                    <select name="trx_type" class="form--select form--control select2" data-minimum-results-for-search="-1">
                        <option value="">@lang('All')</option>
                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                    </select>
                </div>
                <div class="flex-grow-1">
                    <label class="text-white">@lang('Remark')</label>
                    <select class="form--select form--control select2" data-minimum-results-for-search="-1" name="remark">
                        <option value="">@lang('Any')</option>
                        @foreach ($remarks as $remark)
                            <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>{{ __(keyToTitle($remark->remark)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-grow-1 align-self-end">
                    <button class="btn btn--dark w-100"><i class="las la-filter"></i> @lang('Filter')</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card custom--card">
        <div class="card-body p-0">
            @if (!blank($transactions))
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('Trx')</th>
                                <th>@lang('Transacted')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Detail')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td>
                                        <strong>{{ $trx->trx }}</strong>
                                    </td>

                                    <td>
                                        {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                    </td>

                                    <td class="budget">
                                        <span class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                            {{ $trx->trx_type }} {{ showAmount($trx->amount) }} {{ gs('cur_text') }}
                                        </span>
                                    </td>

                                    <td class="budget">
                                        {{ showAmount($trx->post_balance) }} {{ __(gs('cur_text')) }}
                                    </td>


                                    <td>{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5">
                    <div class="empty-template">
                        <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                        <p>@lang('No transactions yet!')</p>
                    </div>
                </div>
            @endif
        </div>
        @if ($transactions->hasPages())
            <div class="card-footer">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
@endsection

@push('style')
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #4051cf !important;
            border: 1px solid #cacaca73 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff !important;
        }

        .select2 .dropdown-wrapper {
            display: none;
        }

        .select2-container:has(.select2-selection--single) {
            width: 100% !important;
            min-width: 140px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            color: #fff !important;
        }
    </style>
@endpush
