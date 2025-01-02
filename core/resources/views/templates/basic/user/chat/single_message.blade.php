<div class="single-message  @if ($chatMessage->sender == 'user') message--right @else message--left @endif">
    <div class="message-content-outer">
        <div class="message-content">
            <p class="message-text">{{ __($chatMessage->message) }}</p>
        </div>
        <span class="message-time d-block text-end mt-2">{{ diffForHumans($chatMessage->created_at) }}</span>
    </div>
</div>
