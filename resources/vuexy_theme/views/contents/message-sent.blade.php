<ul class="email-media-list">
    @forelse($messages as $message)
    <li class="media" data-id="{{$message->id}}">
        <div class="media-left pr-50">
            <div class="avatar">
                <img src="{{ asset(env('APP_THEME', 'default') . '/app-assets/images/avatars/noface.png')}}" alt="avatar img holder" />
            </div>
            <div class="user-action">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input list-checkbox" id="customCheck{{$loop->index}}" value="{{$message->id}}" />
                    <label class="custom-control-label" for="customCheck{{$loop->index}}"></label>
                </div>
            </div>
        </div>
        <div class="media-body">
            <div class="mail-details">
                <div class="mail-items">
                    <h5 class="mb-25">{{$message->email}}</h5>
                    <span class="text-truncate">{{$message->subject}}</span>
                </div>
                <div class="mail-meta-item">
                    <span class="mail-date">{{$message->created_at->diffForHumans()}}</span>
                </div>
            </div>
            <div class="mail-message">
                <p class="text-truncate mb-0">
                    {!!$message->message!!}
                </p>
            </div>
        </div>
    </li>
    @empty 
    <div class="no-results show">
        <h5>No Items Found</h5>
    </div>
    @endforelse
</ul>
<div class="no-results">
    <h5>No Items Found</h5>
</div>