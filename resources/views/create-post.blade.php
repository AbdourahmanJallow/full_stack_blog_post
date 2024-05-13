@extends('layout.layout') @section("content")

<div class="flex flex-col justify-center lg:items-start">
    <div class="px-4 w-full">
        <h1 class="font-bold text-3xl md:text-5xl mb-2 text-pink-500">
            Post New Blog
        </h1>
        <div class="h-[1px] bg-slate-700 w-full mb-10"></div>

        <form
            action="{{ route('post.create') }}"
            method="post"
            enctype="multipart/form-data"
            class="flex flex-col gap-5 justify-center items-center w-full lg:w-1/2"
        >
            @csrf
            <input
                class="input input-bordered input-md w-full"
                name="title"
                type="text"
                placeholder="Title"
            />

            <textarea
                type="text"
                name="content"
                class="textarea textarea-lg textarea-bordered w-full"
                rows="4"
                placeholder="Content"
            >
            </textarea>

            <div class="w-full flex flex-col justify-start my-2">
                <label for="image" class="mb-2 text-white">Blog Image</label>
                <input
                    name="image"
                    type="file"
                    className="file-input file-input-bordered file-input-error file-input-lg w-full"
                />
            </div>

            <div class="w-full flex justify-end mt-4">
                <button class="btn btn-md btn-success w-full" type="submit">
                    Post
                </button>
            </div>
            @include('shared.error')
        </form>
    </div>
</div>
@endsection
