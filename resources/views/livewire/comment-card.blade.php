<div class="relative">
    <div class="chat chat-start">
        @if(!$comment->user)
        <div class="avatar placeholder">
            <div class="bg-neutral text-neutral-content rounded-full w-10">
                <span class="text-3xl">#</span>
            </div>
            @if($comment->parent_id && !$isLast)
            <div
                class="absolute left-4 top-10 bottom-0 w-px bg-slate-600"
            ></div>
            @endif
        </div>
        @elseif($comment->user->profile_image)

        <div
            class="chat-image avatar tooltip tooltip-bottom"
            data-tip="{{$comment->user->name}}"
        >
            <div class="w-10 rounded-full">
                <img
                    class=""
                    alt="user_image"
                    src="{{$comment->user->profile_image}}"
                />
            </div>
            @if($comment->parent_id)
            <div
                class="absolute left-4 top-10 bottom-0 w-px bg-slate-600"
            ></div>
            @endif
        </div>
        @endif

        <div class="chat-bubble text-sm text-white">
            <div>
                {{$comment->content}}
            </div>
            @if(auth()->user())
            <div class="flex justify-start items-end gap-3 p-2">
                <button
                    wire:click="toggleInput"
                    class="hover:cursor-pointer text-xs text-slate-600"
                >
                    reply
                </button>
                @if(auth()->user()->id == $comment->user_id)
                <button
                    wire:click="destroy({{$comment->id}})"
                    class="p-1 cursor-pointer tooltip tooltip-bottom"
                    data-tip="delete"
                >
                    <x-icons.trash class="w-[15px] h-[14px] text-slate-500" />
                </button>
                @endif
            </div>
            @endif
        </div>
    </div>

    @if($showInput)
    <div class="mx-10 max-w-fit">
        <form
            wire:submit="store"
            class="lg flex justify-between gap-5 mt-2"
            method="post"
        >
            @csrf @method('POST')
            <input
                name="reply"
                wire:model="reply"
                type="text"
                class="input input-xs input-bordered w-full p-2"
            />

            <div class="flex flex-col justify-end">
                <button
                    wire:click="toggleInput"
                    type="submit"
                    class="px-3 text-sm rounded-lg bg-white text-black"
                >
                    reply
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="ml-10 mt-2">
        @if ($comment->children) @foreach ($comment->children as $reply)
        <livewire:comment-card
            :key="$reply->id"
            :comment="$reply"
            :isLast="$loop->last"
        />
        @endforeach @endif
    </div>
</div>
