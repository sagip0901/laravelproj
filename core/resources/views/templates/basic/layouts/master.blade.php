<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> {{ gs()->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')

    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'user/css/lightcase.min.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/slick.css') }}" rel="stylesheet">

    @stack('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <link href="{{ asset($activeTemplateTrue . 'user/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet">
    @stack('style')

</head>

<body>
    <div class="merchant-dashboard">
        @include('Template::partials.sidenav')
        @include('Template::partials.auth_topbar')

        <div class="merchant-dashboard__body mt-5">
            @if (@$setting)
                @include('Template::partials.setting_tab')
            @endif
            @yield('content')

        </div>

        <script src="{{ asset('assets/global/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

        @stack('script-lib')

        <script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'user/js/lightcase.min.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/jquery.validate.js') }}"></script>

        <script src="{{ asset($activeTemplateTrue . 'user/js/wow.min.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'user/js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'user/js/jquery.paroller.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/nicEdit.js') }}"></script>
        <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'user/js/app.js') }}"></script>

        @include('partials.plugins')
        @include('partials.notify')
        @stack('script')

        <script>
            bkLib.onDomLoaded(function() {
                $(".nicEdit").each(function(index) {
                    $(this).attr("id", "nicEditor" + index);
                    new nicEditor({
                        fullPanel: true
                    }).panelInstance('nicEditor' + index, {
                        hasPanel: true
                    });
                });
            });

            (function($) {
                "use strict";
                $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
                    $('.nicEdit-main').focus();
                });

                function formatState(state) {
                    if (!state.id) return state.text;
                    let gatewayData = $(state.element).data();
                    return $(
                        `<div class="d-flex gap-2">${gatewayData.imageSrc ? `<div class="select2-image-wrapper"><img class="select2-image" src="${gatewayData.imageSrc}"></div>` : '' }<div class="select2-content"> <p class="select2-title">${gatewayData.title}</p><p class="select2-subtitle">${gatewayData.subtitle}</p></div></div>`
                    );
                }

                $('.select2').each(function(index, element) {
                    $(element).select2();
                });

                $('.select2-basic').each(function(index, element) {
                    $(element).select2({
                        dropdownParent: $(element).closest('.select2-parent')
                    });
                });

                $.each($('.select2'), function() {
                    $(this)
                        .wrap(`<div class="position-relative"></div>`)
                        .select2({
                            dropdownParent: $(this).parent()
                        });
                });

                $('.showFilterBtn').on('click', function() {
                    $('.responsive-filter-card').slideToggle();
                });

                var inputElements = $('[type=text],select,textarea');
                $.each(inputElements, function(index, element) {
                    element = $(element);
                    element.closest('.form-group').find('label').attr('for', element.attr('name'));
                    element.attr('id', element.attr('name'))
                });

                $.each($('input, select, textarea'), function(i, element) {
                    var elementType = $(element);
                    if (elementType.attr('type') != 'checkbox') {
                        if (element.hasAttribute('required')) {
                            $(element).closest('.form-group').find('label').addClass('required');
                        }
                    }
                });

                Array.from(document.querySelectorAll('table')).forEach(table => {
                    let heading = table.querySelectorAll('thead tr th');
                    Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                        Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                            colum.setAttribute('data-label', heading[i].innerText)
                        });
                    });
                });

            })(jQuery)
        </script>
</body>

</html>
