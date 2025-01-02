@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.open.ai.setting.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Template Model')</label>
                                    <select class="form-control" name="template_model_id">
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($templateModels as $templateModel)
                                            <option value="{{ $templateModel->id }}" @selected($templateModel->id == @gs('template_model_id'))>{{ __($templateModel->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Chat Model')</label>
                                    <select class="form-control" name="chat_model_id">
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($chatModels as $chatModel)
                                            <option value="{{ $chatModel->id }}" @selected($chatModel->id == @gs('chat_model_id'))>{{ __($chatModel->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('API Secret Key')</label>
                                    <input class="form-control" name="api_key" type="text" value="{{ @gs('api_key') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Max Result Length')</label>
                                    <div class="input-group">
                                        <input class="form-control" name="max_result_length" type="number" value="{{ @gs('max_result_length') }}">
                                        <span class="input-group-text">@lang('word')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
