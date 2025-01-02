@foreach ($items as $item)
    <div class="col-md-3 col-sm-4 col-6">
        <div class="generator-image__item">
            <div class="generator-image__item-img" style="background-image: url({{ getImage(getFilePath('ai_image') . '/' . $item->image) }})">
                <div class="generator-image__view">
                    <ul>
                        <li><a href="{{ route('user.image.download', $item->id) }}"><i class="las la-arrow-circle-down"></i></a></li>
                        <li><a href="{{ route('user.image.remove', $item->id) }}"><i class="las la-times"></i></a></li>
                    </ul>
                </div>
            </div>
            <p>{{ __(@$item->name) }}</p>
        </div>
    </div>
@endforeach
