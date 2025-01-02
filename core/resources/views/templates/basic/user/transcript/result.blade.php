<tr>
    <td>
        <span class="avatar">
            <i class="las la-audio-description fs--24px"></i>
        </span>
    </td>
    <td>
        {{ strLimit($transcript->description, 100) }}
    </td>
    <td>
        <div class="dropdown">
            <button class="action-btn" type="button" id="actionButton" data-bs-toggle="dropdown"><i class="las la-ellipsis-v"></i></button>
            <div class="dropdown-menu transcript-action">
                <buton class="dropdown-list-item viewBtn" data-description="{{ $transcript->description }}" type="button">
                    <i class="las la-eye"></i> @lang('View')
                </buton>
                <a class="dropdown-list-item" href="{{ route('user.transcript.download', $transcript->id) }}">
                    <i class="las la-arrow-circle-down"></i> @lang('Download')
                </a>
                <buton class="dropdown-list-item confirmationBtn" data-question="@lang('Are you sure to remove this transcript')?" data-action="{{ route('user.transcript.remove', $transcript->id) }}" type="button">
                    <i class="las la-trash-alt"></i> @lang('Delete')
                </buton>
            </div>
        </div>
    </td>
</tr>