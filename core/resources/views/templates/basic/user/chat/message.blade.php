@foreach ($conversations->reverse() as $conversation)
    <div class="single-message  @if ($conversation->sender == 'user') message--right @else message--left @endif">
        <div class="message-content-outer">
            <div class="message-content">
                <p class="message-text">{{ __(@$conversation->message) }}</p>
            </div>
            <span class="message-time d-block text-end mt-2">{{ diffForHumans($conversation->created_at) }}</span>
        </div>
    </div>
@endforeach
