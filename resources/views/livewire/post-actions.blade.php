<div class="mt-5 flex gap-1 items-center rounded-md py-3">
    <!-- <form wire:submit="destroyLike"> -->

    @if(auth()->user())
    <button
        @if($isliked)
        wire:click="destroylike"
        @else
        wire:click="storelike"
        @endif
        class="btn btn-sm btn-ghost"
    >
        <x-icons.thumb-up
            class="w-6 h-6 {{ $isliked ? 'text-[#24a0ed]' : '' }}"
        />
        @if($totalLikes > 0)
        <div class="">
            {{ $totalLikes }}
        </div>
        @endif
    </button>

    <button class="btn btn-sm btn-ghost">
        <x-icons.thumb-down class="w-6 h-6" />
    </button>
    @endif
    <button class="btn btn-sm btn-ghost">
        <x-icons.share class="w-6 h-6" />
    </button>
    <button class="btn btn-sm btn-ghost">
        <x-icons.bookmark class="w-6 h-6" />
    </button>
    <button class="btn btn-sm btn-ghost">
        <label for="comment">
            <x-icons.chat class="w-6 h-6" />
        </label>
    </button>
</div>
