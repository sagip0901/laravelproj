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
                                    <th>@lang('Code')</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Description')</th>
                                    <th>@lang('Free')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $template)
                                    <tr>
                                        <td>{{ $template->code }}</td>
                                        <td>{{ __(@$template->category->name) }}</td>
                                        <td>{{ __($template->name) }}</td>
                                        <td>{{ __(strLimit($template->description, 30)) }}</td>
                                        <td>@php echo $template->freeBadge; @endphp</td>
                                        <td>@php echo $template->statusBadge; @endphp</td>
                                        <td>
                                            <div class="button--group">
                                                @if ($template->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to disable this template')?" data-action="{{ route('admin.template.status', $template->id) }}">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-question="@lang('Are you sure to enable this template')?" data-action="{{ route('admin.template.status', $template->id) }}">
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
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($templates->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($templates) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
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
