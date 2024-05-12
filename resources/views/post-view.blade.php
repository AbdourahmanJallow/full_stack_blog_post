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
        {{ \Illuminate\Support\Carbon::parse($post->created_at)->format('F j, Y H:i') }}
    </p>
    <div class="h-[1px] bg-slate-700 w-full" />
    <div
        class="grid grid-cols-1 gap-4 place-content-center mt-10 overflow-hidden"
    >
        <img
            src="{{$post->image}}"
            alt="blog-image"
            class="w-full object-cover rounded-md md:h-[60vh] mb-16"
        />

        <div class="flex flex-col justify-start py-10">
            <p class="text-gray-400 text-wrap">
                {{$post->content}}
            </p>
        </div>
    </div>
</div>
@endsection
