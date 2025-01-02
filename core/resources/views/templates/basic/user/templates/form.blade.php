@extends('Template::layouts.master')
@section('content')
    <div class="py-5">
        <div class="card chatboard-wrapper">
            <div class="card-body">
                <div class="row gy-4 justify-content-center">
                    <div class="col-md-5">
                        <div class="chatboard-right">
                            <div class="template-title">
                                <span>@php echo $template->icon @endphp</span>
                                <span>{{ __($template->name) }}</span>
                                <p>{{ __($template->description) }}</p>
                            </div>
                            <form id="generateTemplate" action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Language')</label>
                                    <select class="form--control select2" name="language">
                                        <option value="" selected disabled>@lang('Select One')</option>
                                        @foreach ($languageList as $langData)
                                            <option value="{{ $langData }}">{{ $langData }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @include('components.viser-form', ['formData' => $formData])

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>@lang('Number of Result')</label>
                                        <select class="form--control select--basic" name="result_quantity">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>@lang('Maximum Result Length')</label>
                                        <input class="form--control" name="words" type="number"
                                            value="{{ gs('max_result_length') }}">
                                    </div>
                                </div>
                                <button class="btn btn--base w-100 generateBtn mt-3"
                                    type="submit">@lang('Generate')</button>
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

                        <textarea class="form-control nicEdit" id="editor" name="" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('style-lib')
    <link href="{{ asset($activeTemplateTrue . 'css/type-writer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/type-writer.js') }}"></script>
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";


            $('#generateTemplate').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let url = "{{ route('user.template.generate', $template->code) }}";
                let processBtn =
                    `<span class="processing"><i class="las la-spinner"></i> @lang('Processing')</span>`;

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
                        if (response.error) {
                            notify('error', response.error);
                            $('.generateBtn').html('');
                            $('.generateBtn').html('Generate');
                            $('.generateBtn').prop('disabled', false);
                            return;
                        }

                        contentProcess(response);
                    }
                });
            });

            function contentProcess(response) {
                let data = {
                    _token: "{{ csrf_token() }}",
                    template_content_id: response.template_content_id,
                    max_token: response.maxtoken
                };
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.template.process') }}",
                    data: data,
                    success: function(response) {
                        $('.generateBtn').html('');
                        $('.generateBtn').html('Generate');
                        $('.generateBtn').prop('disabled', false);
                        if (response.error) {
                            notify('error', response.error);
                            return;
                        }

                        $(document).find('.nicEdit-main').typewriter({
                            text: response.content,
                            delay: 20,
                            cursor: false,
                        });

                        counter();
                    }
                });
            }

            $('.pdfBtn').on('click', function(e) {
                let pdfContent = $(document).find('.nicEdit-main').html();
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
                let wordContent = $(document).find('.nicEdit-main').html();
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
                let textContent = $(document).find('.nicEdit-main').html();
                textContent = textContent.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var link = document.createElement('a');
                var mimeType = 'text/plain';
                link.setAttribute('download', 'document.txt');
                link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(
                    textContent));
                link.click();
            });

            $('.copyBtn').on('click', function(e) {
                let textToCopy = $(document).find('.nicEdit-main').html();
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
