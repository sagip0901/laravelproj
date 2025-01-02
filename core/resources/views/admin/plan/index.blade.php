@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Word Limit')</th>
                                    <th>@lang('Image Limit')</th>
                                    <th>@lang('Minute Limit')</th>
                                    <th>@lang('Discount')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $plan)
                                    <tr>
                                        <td>{{ $plans->firstItem() + $loop->index }}</td>
                                        <td><b><i>@php echo $plan->planTypeBadge; @endphp</i></b></td>
                                        <td>{{ __($plan->name) }}</td>
                                        <td>{{ showAmount($plan->price) }}</td>
                                        <td><span>{{ $plan->wordLimitValue }}</span></td>
                                        <td><span>{{ $plan->imageLimitValue }}</span></td>
                                        <td><span>{{ $plan->minuteLimitValue }}</span></td>
                                        <td>
                                            @if ($plan->is_discount)
                                                <span class="badge badge--info">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--dark">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>@php echo $plan->statusBadge; @endphp</td>
                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.plan.add', $plan->id) }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
                                                @if ($plan->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.plan.status', $plan->id) }}" data-question="@lang('Are you sure to disable this plan')?">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.plan.status', $plan->id) }}" data-question="@lang('Are you sure to enable this plan')?">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($plans->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($plans) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Name" />
    <a href="{{ route('admin.plan.add') }}" class="btn btn-outline--primary h-45"><i class="las la-plus"></i>@lang('Add New')</a>
@endpush

@push('style')
    <style>
        .badge--info {
            border-radius: 999px;
            padding: 2px 15px;
            position: relative;
            border-radius: 999px;
            -webkit-border-radius: 999px;
            -moz-border-radius: 999px;
            -ms-border-radius: 999px;
            -o-border-radius: 999px;
        }

        .badge--info {
            background-color: rgb(30, 159, 242, 0.1);
            border: 1px solid #1e9ff2;
            color: #1e9ff2;
        }
    </style>
@endpush
