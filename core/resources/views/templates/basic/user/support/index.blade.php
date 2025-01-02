@extends('Template::layouts.master')

@section('content')
    <div class="card custom--card">
        <div class="card-header d-flex justify-content-between flex-wrap gap-2 align-items-center">
            <h6>@lang('Support Ticket')</h6>
            <a href="{{ route('ticket.open') }}" class="btn btn--base btn-sm">
                <i class="las la-plus"></i>
                @lang('Add New')
            </a>
        </div>
        <div class="card-body p-0">
            @if(!blank($supports))
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two custom-data-table">
                    <thead>
                        <tr>
                            <th>@lang('Subject')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Priority')</th>
                            <th>@lang('Last Reply')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supports as $key => $support)
                            <tr>
                                <td> <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold">
                                        [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                <td>
                                    @php echo $support->statusBadge; @endphp
                                </td>
                                <td>
                                    @if ($support->priority == 1)
                                        <span class="badge badge--dark">@lang('Low')</span>
                                    @elseif($support->priority == 2)
                                        <span class="badge badge--success">@lang('Medium')</span>
                                    @elseif($support->priority == 3)
                                        <span class="badge badge--primary">@lang('High')</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>
                                <td>
                                    <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn-sm btn--base">
                                        <i class="la la-desktop"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center not-found">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-5">
                <div class="empty-template">
                    <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                    <p>@lang('No support ticket found yet!')</p>
                </div>
            </div>
            @endif
        </div>
        @if ($supports->hasPages())
            <div class="card-footer">
                {{ paginatelinks($supports) }}
            </div>
        @endif
    </div>
@endsection
