@extends('layout.layout') @section('content')
<div class="flex flex-col justify-center w-full px-6 py-5">
    <h1 class="font-bold text-3xl md:text-5xl mb-4 text-pink-500">
        {{$post->title}}
    </h1>
    <p class="text-sm font-light mb-3">
        Written by
        <span class="text-white font-bold">{{$blog_owner->name}}</span>
    </p>
    <p class="text-xs font-light mb-3">
        Created on
        <span
            class="text-white font-bold"
            >{{ \Illuminate\Support\Carbon::parse($post->created_at)->format('F j, Y') }}</span
        >
    </p>
    <div class="h-[1px] bg-slate-700 w-full" />
    <div
        class="grid grid-cols-1 gap-4 place-content-center mt-10 overflow-hidden"
    >
        <img
            src="{{$post->image}}"
            alt="blog-image"
            class="w-full object-cover rounded-md md:h-[60vh] mb-"
        />

        <div class="flex flex-col justify-start py-5">
            <p class="text-white text-wrap">
                {{$post->content}}
            </p>

            <div class="mt-5 flex justify-evenly items-center rounded-md p-3">
                <button class="btn btn-sm btn-ghost">
                    <x-icons.thumb-up class="w-6 h-6" />
                </button>
                <button class="btn btn-sm btn-ghost">
                    <x-icons.thumb-down class="w-6 h-6" />
                </button>
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
            <div
                class="mt-5 w-full flex flex-col border-[1px] border-gray-700 rounded-md px-3 py-8"
            >
                <form
                    action="{{ route('post.comment.store', $post->id) }}"
                    class="lg flex justify-between gap-5"
                    method="post"
                >
                    @csrf @method('POST')
                    <textarea
                        id="comment"
                        name="comment"
                        type="text"
                        class="textarea textarea-sm textarea-bordered w-full p-2"
                    >
                    </textarea>
                    <div class="flex flex-col justify-end">
                        <x-primary-button class="ms-3 min-w-fit">
                            {{ __("Send") }}
                        </x-primary-button>
                    </div>
                </form>

                <h3 class="text-xl text-white mt-10 font-bold">
                    Comments
                    <span
                        class="text-gray-500 font-normal"
                        >{{count($post->comments) > 0 ? count($post->comments) : '' }}</span
                    >
                </h3>

                <div class="flex flex-col justify-start gap-5 mt-2 lg:px-10">
                    @foreach($post->comments as $comment)
                    <div class="chat chat-start">
                        <div class="chat-bubble text-sm text-white">
                            {{$comment->content}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection