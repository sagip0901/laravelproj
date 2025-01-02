@extends('Template::layouts.master')
@section('content')
    <div class=" mb-4">
        <form class="archiver-filter" action="">
            <div class="d-flex flex-wrap gap-3">
                <div class="flex-grow-1">
                    <label class="text-white">@lang('Category')</label>
                    <select class="form--select form--control filter-category" name="archiver_category_id">
                        <option value="">@lang('All Categories')</option>
                        @foreach ($categorise as $category)
                            <option value="{{ $category->id }}" @selected(request()->archiver_category_id == $category->id)>{{ __(keyToTitle($category->name)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-grow-1 align-self-end">
                    <button class="btn btn--dark w-100 addNewArchiver" data-route="{{ route('user.task.archive.store.new') }}" data-title="@lang('Add new archiver')" type="button"><i class="las la-plus"></i> @lang('Add New')</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card custom--card">
        <div class="card-body p-0">
            @if (!blank($archivers))
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('Category')</th>
                                <th>@lang('Content')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($archivers as $archiver)
                                <tr>
                                    <td> {{ __($archiver->archiverCategory->name) }}</td>
                                    <td> {{ strLimit($archiver->content, 340) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn--base me-2 editArchiver" data-resource="{{ $archiver }}" data-route="{{ route('user.task.archive.store.new', $archiver->id) }}" data-title="@lang('Update archiver')"><i class="las la-eye"></i></button>
                                            <button class="btn btn-sm btn--danger me-2 confirmationBtn" data-action="{{ route('user.task.archive.delete', $archiver->id) }}" data-question="@lang('Are you sure to delete this one')?"><i class="las la-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-5">
                    <div class="empty-template">
                        <img src="{{ asset($activeTemplateTrue . 'images/thumbs/empty_list.png') }}">
                        <p>{{ __($emptyMessage) }}</p>
                    </div>
                </div>
            @endif
        </div>
        @if ($archivers->hasPages())
            <div class="card-footer">
                {{ $archivers->links() }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="archiverModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Add New')</h4>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select class="form-control" name="archiver_category" required>
                                        <option value="General">@lang('Category')</option>
                                        @foreach ($categorise as $category)
                                            <option value="{{ $category->id }}">{{ __(keyToTitle($category->name)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>@lang('Is-New')</label>
                                    <input class="form-check-input" id="newCat" type="checkbox">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input class="form-control" name="new_archiver_category" type="text" placeholder="@lang('New Category')" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control content-box" name="content" required rows="15"></textarea>
                            </div>
                        </div>

                        <div class="row flex-wrap-reverse mb-3 gy-3 align-items-center">
                            <div class="col-sm-6">
                                <div class="counter-wrapper ">
                                    <span>@lang('Charater') <p class="charater-lth badge badge--primary">0</p></span>
                                    <span>@lang('Word') <p class="word-lth badge badge--primary">0</p></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="export-btn-list mb-0 ">
                                    <button class="download-btn pdfBtn" type="button"><i class="las la-file-pdf"></i></button>
                                    <button class="download-btn wordBtn" type="button"><i class="las la-file-word"></i></button>
                                    <button class="download-btn txtBtn" type="button"><i class="las la-file"></i></button>
                                    <button class="download-btn copyBtn" type="button"><i class="las la-copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />

@endsection

@push('script')
    <script>
        "use strict";

        $(document).ready(function() {
            $('select.filter-category').on('change', function() {
                let form = $('.archiver-filter');
                form.submit();
            });

            $(".addNewArchiver").on("click", function() {
                var modal = $('#archiverModal').modal('show');
                var title = $(this).data('title');
                modal.find('.modal-title').text(title)

                var action = $(this).data('route');
                $('form').attr('action', action);
            });

            $('#newCat').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#archiver_category').prop('disabled', true);
                    $('#new_archiver_category').prop('disabled', false);
                } else {
                    $('#archiver_category').prop('disabled', false);
                    $('#new_archiver_category').prop('disabled', true);
                }
            });

            $('.content-box').on('paste keyup', function() {
                counter();
            });

            function counter() {
                var text = $('.content-box').val();
                var charCount = text.length;
                $('.charater-lth').text(charCount);
                var wordCount = text.split(/\s+/).filter(Boolean).length;
                $('.word-lth').text(wordCount);
            }
            $('#archiverModal').on('shown.bs.modal', function() {
                counter();
            });

            $(".addNewArchiver").on("click", function() {
                var modal = $('#archiverModal').modal('show');
                var action = '{{ route('user.task.archive.store.new') }}';
                $('form').attr('action', action);
            });

            $(".editArchiver").on("click", function() {
                var modal = $('#archiverModal').modal('show');
                var title = $(this).data('title');
                modal.find('.modal-title').text(title)

                var action = $(this).data('route');
                $('form').attr('action', action);

                var data = $(this).data("resource");
                $("#archiver_category").val(data.archiver_category_id);
                $(".content-box").val(data.content);
            });

            $('.pdfBtn').on('click', function(e) {
                let pdfContent = $(document).find('.content-box').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.download.pdf.content') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: pdfContent
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        var blob = new Blob([response]);
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "document.pdf";
                        link.click();
                    }
                });
            });

            $('.wordBtn').on('click', function(e) {
                let wordContent = $(document).find('.content-box').val();
                wordContent = wordContent.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(wordContent);
                var fileDownload = document.createElement("a");
                document.body.appendChild(fileDownload);
                fileDownload.href = source;
                fileDownload.download = 'document.doc';
                fileDownload.click();
                document.body.removeChild(fileDownload);
            });

            $('.txtBtn').on('click', function(e) {
                let textContent = $(document).find('.content-box').val();
                textContent = textContent.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var link = document.createElement('a');
                var mimeType = 'text/plain';
                link.setAttribute('download', 'document.txt');
                link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(textContent));
                link.click();
            });

            $('.copyBtn').on('click', function(e) {
                let textToCopy = $(document).find('.content-box').val();
                textToCopy = textToCopy.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var tempTextArea = $('<textarea>');
                tempTextArea.val(textToCopy);
                $('body').append(tempTextArea);
                tempTextArea.select();
                document.execCommand('copy');
                tempTextArea.remove();
                notify('success', 'Content copied successfully')
            });



        });
    </script>
@endpush
