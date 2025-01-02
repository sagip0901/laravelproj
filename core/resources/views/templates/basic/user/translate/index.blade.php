@extends('Template::layouts.master')
@section('content')
    <div class="py-5">
        <div class="card chatboard-wrapper">
            <div class="card-body">
                <div class="row gy-4 justify-content-center ">
                    <div class="col-md-5">
                        <div class="chatboard-right">
                            <form id="generateTranslate" action="" method="POST">
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
                                <div class="form-group">
                                    <label>@lang('Write Content')</label>
                                    <textarea class="form--control" name="content" rows="10"></textarea>
                                </div>
                                <button class="btn btn--base w-100 generateBtn mt-3" type="submit">@lang('Generate')</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="export-btn-list">
                            <a href="{{ route('user.translate.list') }}" class="btn btn--base btn-sm"><i class="las la-list-ul"></i> @lang('Previous Data')</a>
                            <button class="btn btn--info btn-sm copyBtn" type="button"><i class="las la-copy"></i></button>
                        </div>
                        <textarea class="form--control show-result" readonly></textarea>
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

            $('.select2-basic').select2();

            $('#generateTranslate').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let url = "{{ route('user.translate.generate') }}";
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

                        $(document).find('.show-result').typewriter({
                            text: response.content,
                            delay: 20,
                            cursor: false,
                        });
                    }
                });
            });

            $('.copyBtn').on('click', function(e) {
                let textToCopy = $(document).find('.show-result').val();
                textToCopy = textToCopy.replace(/<br>/gi, '\n\n').replace(/<[^>]+>/g, '')
                var tempTextArea = $('<textarea>');
                tempTextArea.val(textToCopy);
                $('body').append(tempTextArea);
                tempTextArea.select();
                document.execCommand('copy');
                tempTextArea.remove();
                if (textToCopy) {
                    notify('success', 'Content copied successfully')
                }
            });
        })(jQuery)
    </script>
@endpush
