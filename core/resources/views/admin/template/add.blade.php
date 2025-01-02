@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body">
                    <form action="{{ route('admin.template.store', @$template->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Category')</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="" selected disabled>@lang('Select One')</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($category->id == @$template->category_id)>{{ __($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" name="name" type="text" value="{{ old('name', @$template->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Icon')</label>
                                    <input class="form-control iconPicker" name="icon" type="text" value="{{ old('icon', @$template->icon) }}" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>@lang('Is template free')?</label>
                                <input name="is_free" data-width="100%" data-height="50" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Yes')" data-off="@lang('No')" type="checkbox" @checked(@$template->is_free)>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Description')</label>
                                    <textarea class="form-control" name="description" required maxlength="255">{{ old('description', @$template->description) }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-3 flex-wrap">
                                <label>@lang('Form data')</label>
                                <button class="btn btn-sm btn-outline--primary form-generate-btn" type="button"><i class="la la-plus"></i> @lang('Add New')</button>
                            </div>
                            <div class="row addedField">
                                @foreach (@$template->form_data ?? [] as $formData)
                                    <div class="col-md-4">
                                        <div class="card mb-3 border" id="{{ $loop->index }}">
                                            <input name="form_generator[is_required][]" type="hidden" value="{{ $formData->is_required }}">
                                            <input name="form_generator[extensions][]" type="hidden" value="{{ $formData->extensions }}">
                                            <input name="form_generator[options][]" type="hidden" value="{{ implode(',', $formData->options) }}">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>@lang('Label')</label>
                                                    <input class="form-control" name="form_generator[form_label][]" type="text" value="{{ $formData->name }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>@lang('Type')</label>
                                                    <input class="form-control" name="form_generator[form_type][]" type="text" value="{{ $formData->type }}" readonly>
                                                </div>
                                                @php
                                                    $jsonData = json_encode([
                                                        'type' => $formData->type,
                                                        'is_required' => $formData->is_required,
                                                        'label' => $formData->name,
                                                        'extensions' => explode(',', $formData->extensions) ?? 'null',
                                                        'options' => $formData->options,
                                                        'old_id' => '',
                                                    ]);
                                                @endphp
                                                <div class="btn-group w-100">
                                                    <button class="btn btn--primary editFormData" data-form_item="{{ $jsonData }}" data-update_id="{{ $loop->index }}" type="button"><i class="las la-pen"></i></button>
                                                    <button class="btn btn--danger removeFormData" type="button"><i class="las la-times"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-form-generator />
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.template.index') }}" />
@endpush

@push('style-lib')
    <link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.iconPicker').iconpicker().on('iconpickerSelected', function(e) {
                $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
            });
        })(jQuery)
    </script>

    <script>
        "use strict"
        var formGenerator = new FormGenerator();
        formGenerator.totalField = {{ @$form ? count((array) $form->form_data) : 0 }}
    </script>

    <script src="{{ asset('assets/global/js/form_actions.js') }}"></script>
@endpush
