@extends('Template::layouts.master')
@section('content')
    <div class="py-5">
        <div class="card chatboard-wrapper">
            <div class="card-body">
                <div class="row gy-4 justify-content-center">
                    <div class="col-md-5">
                        <div class="chatboard-right">
                            <div class="template-title">
                                <span><i class="las la-cogs"></i></span>
                                <span>@lang('SEO Content Request')</span>
                                <p>@lang('Get the best SEO title, description, and keyword from Open AI')</p>
                            </div>
                            <form id="generateSeo" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Product Description')</label>
                                    <textarea name="description" class="form--control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Meta Title Length')</label>
                                    <input class="form--control" name="meta_title_length" type="number" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>@lang('Meta Description Length')</label>
                                    <input class="form--control" name="meta_description_length" type="number" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>@lang('Meta Keywords Length')</label>
                                    <input class="form--control" name="meta_keyword_length" type="number" required>
                                </div>
                                <button class="btn btn--base w-100 generateBtn mt-3" type="submit">@lang('Generate')</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="export-btn-list">
                            <button class="download-btn pdfBtn" type="button"><i class="las la-file-pdf"></i></button>
                            <button class="download-btn wordBtn" type="button"><i class="las la-file-word"></i></button>
                            <button class="download-btn txtBtn" type="button"><i class="las la-file"></i></button>
                            <button class="download-btn copyBtn" type="button"><i class="las la-copy"></i></button>
                        </div>
                        <div class="show-result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('style-lib')
    <link href="{{ asset($activeTemplateTrue . 'css/type-writer.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/type-writer.js') }}"></script>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";


            $('#generateSeo').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let url = "{{ route('user.seo.generate') }}";
                let processBtn = `<span class="processing"><i class="las la-spinner"></i> @lang('Processing')</span>`;
                $(document).find('.show-result').text('')
    
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    beforeSend: function() {
                        $('.generateBtn').html('');
                        $('.generateBtn').html(processBtn);
                        $('.generateBtn').prop('disabled', true);
                    },
                    success: function(response) {
                        $('.generateBtn').html('');
                        $('.generateBtn').html('Generate');
                        $('.generateBtn').prop('disabled', false);

                        if (response.error) {
                            notify('error', response.error);
                            return;
                        }
                        $(document).find('.show-result').html(response.content);
                    }
                });
            });



            $('.pdfBtn').on('click', function(e) {
                let pdfContent = $(document).find('.show-result').html();
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
                let wordContent = $(document).find('.show-result').html();
                if (!wordContent) {
                    return false;
                }
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
                let textContent = $(document).find('.show-result').html();
                textContent = textContent.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var link = document.createElement('a');
                var mimeType = 'text/plain';
                link.setAttribute('download', 'document.txt');
                link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(textContent));
                link.click();
            });

            $('.copyBtn').on('click', function(e) {
                let textToCopy = $(document).find('.show-result').html();
                textToCopy = textToCopy.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var tempTextArea = $('<textarea>');
                tempTextArea.val(textToCopy);
                $('body').append(tempTextArea);
                tempTextArea.select();
                document.execCommand('copy');
                tempTextArea.remove();
                notify('success', 'Content copied successfully')
            });
        })(jQuery)
    </script>
@endpush
