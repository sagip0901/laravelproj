@php
    $language = App\Models\Language::all();
    $langDetails = $language->where('code', config('app.locale'))->first();
@endphp

<div class="custom--dropdown">
    <div class="custom--dropdown__selected dropdown-list__item">
        <div class="thumb"> <img class="flag" src="{{ getImage(getFilePath('language') . '/' . $langDetails->image, getFileSize('language')) }}"></div>
        <span class="text">{{ strtoupper($langDetails->code) }}</span>
    </div>
    <ul class="dropdown-list">
        @foreach ($language as $item)
            <li class="dropdown-list__item langSel" data-code="{{ @$item->code }}">
                <div class="thumb"> <img class="flag"
                         src="{{ getImage(getFilePath('language') . '/' . $item->image, getFileSize('language')) }}" loading="lazy"></div>
                <span class="text">{{ strtoupper($item->code) }}</span>
            </li>
        @endforeach
    </ul>
</div>

@push('script')
    <script>
        "use stric";
        $(document).ready(function() {
            $('.langSel').on('click', function(e) {
                let langCode = $(this).data('code');
                window.location.href = "{{ route('home') }}/change/" + langCode;
            });
        });
    </script>
@endpush
