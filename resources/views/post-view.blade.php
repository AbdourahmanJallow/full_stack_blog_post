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
            <!-- <div class="text-white text-wrap">{!! nl2p($post->content) !!}</div> -->
            <div class="text-white text-wrap">
                @foreach (explode("\n\n", $post->content) as $paragraph)
                <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endforeach
            </div>

            <livewire:post-actions
                :isliked="$isliked"
                :isDisliked="$isDisliked"
                :postId="$post->id"
            />

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

            <livewire:comment-section :postId="$post->id" />
        </div>
    </div>
</div>
@endsection
