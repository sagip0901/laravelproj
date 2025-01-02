@extends('Template::layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row gy-4">
                <div class="col-md-5">
                    <div class="remaining-credit-left">
                        <div class="remaining-credit-box ">
                            <div class="remaining-credit-box-top mb-2 d-flex align-items-center justify-content-between">
                                <h6>@lang('Remaining Credits') </h6>
                                <p class="remaining-credit-box-img-limit">
                                    <span><span class="token-limit">{{ getAmount(@$user->access->minute_limit, 0) }}</span> @lang('minutes')</span>
                                </p>
                            </div>
                        </div>
                        <form id="generateText" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" class="form-control form--control" accept=".mp3, .mp4, .mpeg, .mpag, .m4a, .wav, .webm">
                                <span class="file-format">@lang('Supported files : mp3, mp4, mpeg, mpag, m4a, wav, webm')</span>
                            </div>
                            <button class="btn btn--base w-100 generateBtn" type="submit">@lang('Generate')</button>
                        </form>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="table-transcript">
                        <form action="" method="get" class="table-search-form  d-flex justify-content-end">
                            <div class="form-group">
                                <input class="form-control" value="{{ request()->search }}" type="text" name="search" placeholder="Search" id="search">
                                <button type="submit" class="search-btn"><i class="las la-search"></i></button>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Title')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transcripts as $transcript)
                                    <tr>
                                        <td>
                                            <span class="avatar">
                                                <i class="las la-audio-description fs--24px"></i>
                                            </span>
                                        </td>
                                        <td>
                                            {{ strLimit($transcript->description, 100) }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="action-btn" type="button" id="actionButton" data-bs-toggle="dropdown"><i class="las la-ellipsis-v"></i></button>
                                                <div class="dropdown-menu transcript-action">
                                                    <buton class="dropdown-list-item viewBtn" data-description="{{ $transcript->description }}" type="button">
                                                        <i class="las la-eye"></i> @lang('View')
                                                    </buton>
                                                    <a class="dropdown-list-item" href="{{ route('user.transcript.download', $transcript->id) }}">
                                                        <i class="las la-arrow-circle-down"></i> @lang('Download')
                                                    </a>
                                                    <buton class="dropdown-list-item confirmationBtn" data-question="@lang('Are you sure to remove this transcript')?" data-action="{{ route('user.transcript.remove', $transcript->id) }}" type="button">
                                                        <i class="las la-trash-alt"></i> @lang('Delete')
                                                    </buton>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-list">
                                        <td colspan="100%" class="text-center">
                                            <div class="empty-template">
                                                <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}" alt="@lang('image')">
                                                <p>@lang('No transcript generated yet!')</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="viewModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Transcripted Data')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <p class="description"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $(document).on('click', '.viewBtn', function(e) {
                let modal = $("#viewModal");
                modal.find('.description').text($(this).data('description'));
                modal.modal('show');
            });

            $('#generateText').on('submit', function(e) {
                e.preventDefault();
                
                let processBtn = `<span class="processing"><i class="las la-spinner"></i> @lang('Processing')</span>`;

                $('.generateBtn').html('');
                $('.generateBtn').html(processBtn);
                $('.generateBtn').prop('disabled', true);
                
                let formData = new FormData($(this)[0]);
                let url = "{{ route('user.transcript.generate') }}";
                
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    type: "POST",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('.generateBtn').html('');
                        $('.generateBtn').html('Generate');
                        $('.generateBtn').prop('disabled', false);
                        
                        if (response.error) {
                            notify('error', response.error);
                            return;
                        }
                        
                        $(".empty-list").remove();
                        $(document).find('tbody').prepend(response.result);
                        $('.token-limit').text(response.token)
                    }
                });
            });

            $('.action-btn').on('click',function() {
                $(this).parent('.custom-dropdown').toggleClass('show');
            });

            $('.custom-dropdown').on('mouseleave',function() {
                $(this).removeClass('show');
            });
        })(jQuery)
    </script>
@endpush
