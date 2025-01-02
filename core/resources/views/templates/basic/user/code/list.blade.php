@extends('Template::layouts.master')
@section('content')
    <div class="card p-0 widthdraw-table mt-5">
        <div class="card-header d-flex justify-content-between align-items-center gap-2">
            <h6>@lang('All Code')</h6>
            <a href="{{ route('user.code.form') }}" class="btn btn--base btn-sm">
                <i class="las la-plus"></i>
                @lang('Generate New')
            </a>
        </div>
        <div class="card-body">
            @if(!blank($codes))
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two custom-data-table">
                    <thead>
                        <tr>
                            <th>@lang('S.N.')</th>
                            <th>@lang('Lanuage')</th>
                            <th>@lang('Instruction')</th>
                            <th>@lang('Created_at')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($codes as $code)
                            <tr>
                                <td>{{ $codes->firstItem() + $loop->index }}</td>
                                <td>{{ $code->language }}</td>
                                <td>{{ strLimit($code->instruction, 80) }}</td>
                                <td>{{ showDateTime($code->created_at) }} </td>
                                <td>
                                    <a class="btn btn--base btn-sm" href="{{ route('user.code.download', $code->id) }}"><i class="las la-download"></i></a>
                                    <button class="btn btn--danger btn-sm confirmationBtn" data-action="{{ route('user.code.remove', $code->id) }}" data-question="@lang('Are you sure to remove this code')?" type="button"><i class="las la-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($codes->hasPages())
                <div class="pt-4 pb-2">
                    {{ paginatelinks($codes) }}
                </div>
            @endif
            @else
            <div class="empty-template">
                <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                <p>@lang('No code generated yet!')</p>
            </div>
            @endif
        </div>
    </div>
    <x-confirmation-modal />
@endsection
