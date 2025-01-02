@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body">
                    <form action="{{ route('admin.plan.store', @$plan->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('Plan Type')</label>
                                    <select name="type" class="form-control select2" data-minimum-results-for-search="-1" required>
                                        <option value="" selected disabled>@lang('Select One')</option>
                                        <option value="{{ Status::YEARLY_PLAN }}" @selected(old('type', @$plan->type) == Status::YEARLY_PLAN)>@lang('Yearly')</option>
                                        <option value="{{ Status::MONTHLY_PLAN }}" @selected(old('type', @$plan->type) == Status::MONTHLY_PLAN)>@lang('Monthly')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('Name')</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', @$plan->name) }}" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('Price')</label>
                                    <div class="input-group">
                                        <input type="number" name="price" step="any" class="form-control" value="{{ old('price', @$plan->price) }}" required autocomplete="off">
                                        <span class="input-group-text">{{ gs('cur_text') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <i class="las la-bullhorn text--primary f-size--24"></i>
                            <h6>@lang('Discount')</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('Discount')</label>
                                    <select name="is_discount" class="form-control" required>
                                        <option value="{{ Status::NO }}" @selected(old('is_discount', @$plan->is_discount) == Status::NO)>@lang('NO')</option>
                                        <option value="{{ Status::YES }}" @selected(old('is_discount', @$plan->is_discount) == Status::YES)>@lang('Yes')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 discountType d-none">
                                <div class="form-group">
                                    <label>@lang('Discount Type')</label>
                                    <select name="discount_type" class="form-control">
                                        <option value="" selected disabled>@lang('Select One')</option>
                                        <option value="{{ Status::FIXED_DISCOUNT }}" @selected(old('discount_type', @$plan->discount_type) == Status::FIXED_DISCOUNT)>@lang('Fixed')</option>
                                        <option value="{{ Status::PERCENT_DISCOUNT }}" @selected(old('discount_type', @$plan->discount_type) == Status::PERCENT_DISCOUNT)>@lang('Percent')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 discountAmount d-none">
                                <div class="form-group">
                                    <label>@lang('Discount Amount')</label>
                                    <div class="input-group">
                                        <input type="number" name="discount_amount" step="any" class="form-control" value="{{ old('discount_amount', @$plan->discount_amount) }}" autocomplete="off">
                                        <span class="input-group-text"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 my-3">
                            <i class="las la-sitemap text--primary f-size--24"></i>
                            <h6>@lang('Features')</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('AI Template')</label>
                                    <select name="ai_template" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('ai_template', @$plan->ai_template) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('ai_template', @$plan->ai_template) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Word Limit')</label>
                                    <div class="input-group">
                                        <input type="number" name="word_limit" value="{{ old('word_limit', @$plan->word_limit) }}" class="form-control" >
                                        <span class="input-group-text">@lang('Tokens')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('AI Image')</label>
                                    <select name="ai_image" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('ai_image', @$plan->ai_image) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('ai_image', @$plan->ai_image) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Image Limit')</label>
                                    <div class="input-group">
                                        <input type="number" name="image_limit" value="{{ old('image_limit', @$plan->image_limit) }}" class="form-control" >
                                        <span class="input-group-text">@lang('Qty')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Speech To Text')</label>
                                    <select name="ai_transcript" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('ai_transcript', @$plan->ai_transcript) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('ai_transcript', @$plan->ai_transcript) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Minutes Limit')</label>
                                    <div class="input-group">
                                        <input type="number" name="minute_limit" value="{{ old('minute_limit', @$plan->minute_limit) }}" class="form-control" >
                                        <span class="input-group-text">@lang('Minutes')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('AI Code')</label>
                                    <select name="ai_code" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('ai_code', @$plan->ai_code) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('ai_code', @$plan->ai_code) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('AI Chat')</label>
                                    <select name="ai_chat" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('ai_chat', @$plan->ai_chat) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('ai_chat', @$plan->ai_chat) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Premimum Template')</label>
                                    <select name="premium_template" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('premium_template', @$plan->premium_template) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('premium_template', @$plan->premium_template) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Premimum Chat Bot')</label>
                                    <select name="premium_chat" class="form-control" required>
                                        <option value="{{ Status::YES }}" @selected(old('premium_chat', @$plan->premium_chat) == Status::YES)>@lang('Allow')</option>
                                        <option value="{{ Status::NO }}" @selected(old('premium_chat', @$plan->premium_chat) == Status::NO)>@lang('Deny')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.plan.index') }}" />
@endpush

@push('style')
    <style>
        .discount-headline i {
            font-size: 20px;
        }
    </style>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";
            $('[name=is_discount]').on('change', function(e) {
                if (parseInt($(this).val())) {
                    $('.discountType').removeClass('d-none');
                } else {
                    $('.discountType').addClass('d-none');
                    $('.discountAmount').addClass('d-none');
                    $('.discountAmount').find('span').text('')
                }
            }).change();

            $('[name=discount_type]').on('change', function(e) {
                if (parseInt($(this).val())) {
                    $('.discountAmount').removeClass('d-none');
                    if (parseInt($(this).val()) == 1) {
                        $('.discountAmount').find('span').text(`{{ gs('cur_text') }}`);
                    } else {
                        $('.discountAmount').find('span').text(`%`);
                    }
                } else {
                    $('.discountAmount').addClass('d-none');
                }
            }).change();

            $('[name=ai_transcript]').on('change', function(e) {
                if (parseInt($(this).val())) {
                    $('[name=minute_limit]').prop('required', true);
                } else {
                    $('[name=minute_limit]').prop('required', false);
                }
            });

            $('[name=ai_template]').on('change', function(e) {
                if (parseInt($(this).val())) {
                    $('[name=word_limit]').prop('required', true);
                } else {
                    $('[name=word_limit]').prop('required', false);
                }
            });
            $('[name=ai_image]').on('change', function(e) {
                if (parseInt($(this).val())) {
                    $('[name=image_limit]').prop('required', true);
                } else {
                    $('[name=image_limit]').prop('required', false);
                }
            });

        })(jQuery)
    </script>
@endpush
