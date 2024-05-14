@extends('layout.layout') @section('content')
<div class="w-full px-6 py-5">
    <h1 class="font-bold text-3xl md:text-5xl mb-4 text-pink-500">
        {{$post->title}}
    </h1>

    <div class="h-[1px] bg-slate-700 w-full" />
    <div
        class="grid grid-cols-1 gap-4 place-content-center mt-10 overflow-hidden"
    >
        <img
            src="{{$post->image}}"
            alt="blog-image"
            class="w-full object-cover rounded-md md:h-[60vh] mb-"
        />

        <div class="py-5">
            <p class="text-white text-wrap">
                {{$post->content}}
            </p>

            <div class="mt-5 flex gap-1 items-center rounded-md py-3">
                @if(auth()->user())
                <form
                    method="post"
                    action="{{ $isliked ? route('post.like.destroy', $post->id) : route('post.like.store', $post->id)}}"
                >
                    @csrf @method('POST')
                    <button type="submit" class="btn btn-sm btn-ghost">
                        <x-icons.thumb-up
                            class="w-6 h-6 {{
                                $isliked ? 'text-blue-500' : ''
                            }}"
                        />
                    </button>
                </form>

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

            <div class="relative mt-2 flex gap-4">
                @if($blog_owner->profile_image)
                <div class="avatar">
                    <div class="w-16 rounded-xl">
                        <img src="{{$blog_owner->profile_image}}" />
                    </div>
                </div>

                <!-- <div class="avatar placeholder">
                    <div
                        class="bg-slate-500 text-neutral-content rounded-full w-24"
                    >
                        <span class="text-3xl">D</span>
                    </div>
                </div> -->
                @endif
                <div class="flex flex-col justify-end">
                    <p class="text-xl text-start text-white">
                        {{$blog_owner->name}}
                    </p>
                    <a class="text-xs link link-hover" href="">
                        {{$blog_owner->email}}
                    </a>
                </div>
            </div>
            <div
                class="mt-5 w-full flex flex-col border-[1px] border-slate-700 rounded-md px-3 py-8"
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
                    <span
                        class="text-gray-500 font-normal"
                        >{{count($post->comments) > 0 ? count($post->comments) : '' }}</span
                    >
                    Comment(s)
                </h3>

                <div class="flex flex-col justify-start gap-5 mt-2 lg:px-10">
                    @foreach($post->comments as $comment)
                    @include('shared.comment-card') @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
