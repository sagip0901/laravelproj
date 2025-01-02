@extends('Template::layouts.master')
@section('content')
    <div class="py-5">
        <div class="card chatboard-wrapper">
            <div class="card-body">
                <div class="row gy-4 justify-content-center">
                    <div class="col-md-12">
                        <div class="row flex-wrap-reverse mb-3 gy-3 align-items-center">
                            <div class="col-sm-6">
                                <div class="counter-wrapper ">
                                    <button class="download-btn convertCaseBtn" type="button"><i class="las la-font"></i> @lang('Text Transform')</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="export-btn-list mb-0 ">
                                    <button class="download-btn pdfBtn" type="button"><i class="las la-file-pdf"></i></button>
                                    <button class="download-btn wordBtn" type="button"><i class="las la-file-word"></i></button>
                                    <button class="download-btn txtBtn" type="button"><i class="las la-file"></i></button>
                                    <button class="download-btn copyBtn" type="button"><i class="las la-copy"></i></button>
                                    <button class="download-btn archiverBtn" data-bs-toggle="tooltip" type="button" title="@lang('Archive')"><i class="las la-archive"></i></button>
                                </div>
                            </div>
                        </div>
                        <textarea class="form-control letter-box" id="editor" name="" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.pdfBtn').on('click', function(e) {
                let pdfContent = $(document).find('.letter-box').val();
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
                let wordContent = $(document).find('.letter-box').val();
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
                let textContent = $(document).find('.letter-box').val();
                textContent = textContent.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var link = document.createElement('a');
                var mimeType = 'text/plain';
                link.setAttribute('download', 'document.txt');
                link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(textContent));
                link.click();
            });

            $('.copyBtn').on('click', function(e) {
                let textToCopy = $(document).find('.letter-box').val();
                textToCopy = textToCopy.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var tempTextArea = $('<textarea>');
                tempTextArea.val(textToCopy);
                $('body').append(tempTextArea);
                tempTextArea.select();
                document.execCommand('copy');
                tempTextArea.remove();
                notify('success', 'Content copied successfully')
            });

            $('.convertCaseBtn').on('click', function(e) {
                var targetElement = $('.letter-box');
                if (targetElement.length > 0) {
                    var currentText = targetElement.val();
                    var toggledText = currentText === currentText.toUpperCase() ? currentText.toLowerCase() : currentText.toUpperCase();
                    targetElement.val(toggledText);
                }
            });


            $('.archiverBtn').on('click', function(e) {
                e.preventDefault();
                let url = "{{ route('user.task.archive.store') }}";
                let checkingBtn = `<span class="processing"><i class="las la-spinner"></i></span>`;
                var btnName = `<i class="las la-archive"></i>`;
                var btn = $(this);
                var text = $(document).find('.letter-box').val();
                if (!text) {
                    notify('error', 'Empty content not allowed!');
                    return;
                }

                let dataVal = {
                    _token: "{{ csrf_token() }}",
                    content: text,
                    identifier: `{{ getTrx() }}`,
                    category: "Letter Togglize",
                };

                $.ajax({
                    type: "POST",
                    url: url,
                    data: dataVal,
                    beforeSend: function() {
                        btn.html(checkingBtn);
                        btn.prop('disabled', true);
                    },
                    success: function(response) {
                        btn.html(btnName);
                        btn.prop('disabled', false);
                        if (response.error) {
                            notify('error', response.error);
                            return;
                        }
                        notify('success', response.notify)
                    }
                });
            });


        })(jQuery)
    </script>
@endpush

@push('style')
    <style>
        @media (max-width: 575px) {

            .export-btn-list,
            .counter-wrapper {
                text-align: center;
            }
        }
    </style>
@endpush
