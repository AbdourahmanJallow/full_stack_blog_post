<div
    class="mt-5 w-full flex flex-col border-[1px] border-slate-700 rounded-md px-3 py-8"
>
    <form
        wire:submit="store"
        class="lg flex justify-between gap-5"
        method="post"
    >
        @csrf @method('POST')
        <input
            name="content"
            wire:model="content"
            type="text"
            class="input input-sm input-bordered w-full p-2"
        />

        <div class="flex flex-col justify-end">
            <x-primary-button class="ms-3 min-w-fit">
                {{ __("Post") }}
            </x-primary-button>
        </div>
    </form>

    <h3 class="text-xl text-white mt-10 font-bold">
        <span
            class="text-gray-500 font-normal"
            >{{count($post->comments) > 0 ? count($post->comments) : '' }}</span
        >
        Comment(s)
    </h3>

    <div class="flex flex-col justify-start gap-5 mt-4 lg:px-10">
        @foreach($comments as $comment)
        <livewire:comment-card
            :key="$comment->id"
            :comment="$comment"
            :isLast="$loop->last"
        />
        @endforeach
    </div>
</div>
