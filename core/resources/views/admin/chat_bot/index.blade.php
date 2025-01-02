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
                                    <th>@lang('Image')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Designation')</th>
                                    <th>@lang('Free')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($chatBots as $chatBot)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">.
                                                    <img src="{{ getImage(getFilePath('chat_bot') . '/' . $chatBot->image, getFileSize('chat_bot')) }}" alt="@lang('image')">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ __($chatBot->name) }}</td>
                                        <td>{{ __($chatBot->designation) }}</td>
                                        <td>
                                            @if ($chatBot->is_free)
                                                <span class="badge badge--info">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>@php echo $chatBot->statusBadge; @endphp</td>
                                        <td>
                                            <div class="button--group">
                                                @if ($chatBot->status == Status::ENABLE)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.chat.bot.status', $chatBot->id) }}" data-question="@lang('Are you sure to disable this chat bot')?">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.chat.bot.status', $chatBot->id) }}" data-question="@lang('Are you sure to enable this chat bot')?">
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
                @if ($chatBots->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($chatBots) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="chatBotModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5">
                                <div class="form-group">
                                    <label>@lang('Image')<span class="text--danger">*</span></label>
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage('/', getFileSize('chat_bot')) }})">
                                                    <button class="remove-image" type="button"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input class="profilePicUpload" id="profilePicUpload1" name="image" type="file" accept=".png, .jpg, .jpeg">
                                                <label class="bg--primary" for="profilePicUpload1">@lang('Upload Image')</label>
                                                <small class="mt-2">@lang('Supported files'):
                                                    <b>@lang('jpeg'), @lang('jpg'), @lang('png').</b>
                                                    @lang('Image will be resized into '){{ getFileSize('chat_bot') }} @lang('px')
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-7">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Designation')</label>
                                    <input class="form-control" name="designation" type="text" value="{{ old('designation') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Free')</label>
                                    <select name="is_free" class="form-control" required>
                                        <option value="{{ Status::NO }}">@lang('No')</option>
                                        <option value="{{ Status::YES }}">@lang('Yes')</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Description')</label>
                                    <textarea name="description" class="form-control" required rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
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
        .image-upload .thumb .profilePicPreview {
            height: 230px;
        }

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
