<!-- <div class="chat chat-start">
    <div class="chat-bubble text-sm text-white">
        {{$comment->content}}
    </div>
</div> -->

<div class="chat chat-start">
    @if(!$comment->user)
    <div class="avatar placeholder">
        <div class="bg-neutral text-neutral-content rounded-full w-12">
            <span class="text-3xl">#</span>
        </div>
    </div>
    @elseif($comment->user->profile_image)
    <div class="chat-image avatar">
        <div class="w-10 rounded-full">
            <img
                class=""
                alt="user_image"
                src="{{$comment->user->profile_image}}"
            />
        </div>
    </div>
    @endif

    <div class="chat-bubble text-sm text-white">{{$comment->content}}</div>
</div>
