@extends('layout.layout') @section('content')
<div class="flex flex-col justify-center w-full px-6 py-5">
    <h1 class="font-bold text-3xl md:text-5xl mb-4 text-pink-500">
        Latest Blogs
    </h1>
    <p class="text-sm font-light mb-3">Blogs created with Laravel 11</p>
    <div class="h-[1px] bg-slate-700 w-full" />
    <div class="grid grid-cols-1 gap-4 place-content-center mt-10">
        @foreach($posts as $post)
        <!-- Display post card -->
        @include('shared.post-card') @if(!$loop->last)
        <div class="h-[1px] bg-slate-700 w-full my-5"></div>
        @endif @endforeach
    </div>
    @include('layout.footer')
</div>
@endsection
