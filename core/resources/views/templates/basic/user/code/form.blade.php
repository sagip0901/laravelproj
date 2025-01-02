@extends('Template::layouts.master')
@section('content')
    <div class="py-5">
        <div class="card chatboard-wrapper">
            <div class="card-body">
                <div class="row gy-4 justify-content-center">
                    <div class="col-md-4">
                        <form id="generateCode" action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>@lang('Programming Language')</label>
                                <select class="form-select form--control select2" name="language">
                                    <option value="" selected disabled>@lang('Select One')</option>
                                    @foreach ($languageList as $langData)
                                        <option value="{{ $langData }}">{{ $langData }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('Instruction')</label>
                                <textarea class="form-control form--control" name="instruction" placeholder="@lang('Describe your instruction')"></textarea>
                            </div>
                            <button class="btn btn--base w-100 generateBtn" type="submit">@lang('Generate')</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="chatboard-left">
                            <div class="code-result">
                                <div class="chat-box">
                                    <div class="chat-code no-code">
                                        <pre><code class="language-javascript">@lang('generated code will go here')...</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'user/css/atom-one-dark.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'user/js/highlight.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'user/js/clipboard.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .code-result {
            height: 500px;
        }

        .processing i {
            animation: processing .8s linear infinite;
        }

        @keyframes processing {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }


        .chat-box {
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        .chat-output {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            font-family: monospace;
        }

        .chat-code {
            font-family: monospace;
        }

        .chat-code-header {
            background-color: #343541;
            color: #D9D9E3;
            font-size: 0.875rem;
            font-weight: 400;
            padding: 5px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .language-name {
            font-weight: bold;
        }

        .copy-button {
            background-color: transparent;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        pre code.hljs {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";

            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });

            $('#generateCode').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                let url = "{{ route('user.code.generate') }}";
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
                        $('.generateBtn').prop('disabled', false);
                        $('.generateBtn').html('');
                        $('.generateBtn').html('Generate');
                        if (response.error) {
                            notify('error', response.error);
                            return;
                        }

                        $(document).find('.code-result').html(response.result);

                        // Initialize Highlight.js
                        document.querySelectorAll('pre code').forEach((block) => {
                            hljs.highlightBlock(block);
                        });

                        // Initialize Clipboard.js
                        var clipboard = new ClipboardJS('.copy-button', {
                            target: function(trigger) {
                                return trigger.parentElement.nextElementSibling.querySelector('code');
                            }
                        });

                        clipboard.on('success', function(e) {
                            e.clearSelection();
                            var button = e.trigger;
                            button.innerHTML = '<i class="la la-check"></i> Copied';
                            setTimeout(function() {
                                button.innerHTML = '<i class="la la-copy"></i> Copy';
                            }, 2000);
                        });
                    }
                });
            });
        })(jQuery)
    </script>
@endpush
