@extends('layout.layout') @section("content")

<div class="flex flex-col justify-center lg:items-start">
    @if ($errors->any())
    <div role="alert" className="alert alert-error">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            className="stroke-current shrink-0 h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
        >
            <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </svg>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="px-4 w-full">
        <h3 class="text-3xl md:text-5xl text-white mb-10">Update Blog</h3>

        <form
            action="{{ route('post.update', ['id'=>request()->route('id')]) }}"
            method="post"
            class="flex flex-col gap-5 justify-center items-center w-full lg:w-1/2"
        >
            @csrf @method('PUT')
            <input
                class="input input-bordered input-md w-full"
                name="title"
                type="text"
                value="{{$post->title}}"
                placeholder="Title"
            />

            <textarea
                placeholder="Content"
                name="content"
                class="textarea textarea-lg textarea-bordered w-full"
                rows="4"
            >
            {{$post->content}}
            </textarea>

            <div class="w-full flex justify-end mt-4">
                <button class="btn btn-md btn-success w-full" type="submit">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
