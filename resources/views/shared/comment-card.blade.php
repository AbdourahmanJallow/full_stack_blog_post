<div class="chat chat-start">
    @if(!$comment->user)
    <div class="avatar placeholder">
        <div class="bg-neutral text-neutral-content rounded-full w-12">
            <span class="text-3xl">#</span>
        </div>
        <div
            class="absolute inset-y-12 inset-x-4 bg-slate-600 h-5 w-[1px]"
        ></div>
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
        <div
            class="absolute inset-y-11 inset-x-4 bg-slate-600 h-5 w-[1px]"
        ></div>
    </div>
    @endif

    <div class="chat-bubble text-sm text-white">{{$comment->content}}</div>
</div>
