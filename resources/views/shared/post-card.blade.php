<div
    class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 place-content-start py-4 text-gray-500"
>
    <div class="flex flex-col justify-between overflow-hidden">
        <img src="{{$post->image}}" class="rounded-sm object-contain w-full" />
        <p class="mt-4 text-xs">
            {{ \Illuminate\Support\Carbon::parse($post->created_at)->format('F j, Y') }}
        </p>
    </div>
    <div class="lg:col-span-2 flex flex-col justify-between overflow-hidden">
        <div>
            <h2 class="text-white text-lg lg:text-3xl mb-5">
                {{$post->title}}
            </h2>
            <p class="">
                @if(strlen($post->content) < 200)
                {{ $post->content }}
                @else
                {{ substr($post->content, 0, 200) }}... @endif
            </p>
        </div>
        <div class="flex justify-between items-center">
            <a
                class="link link-hover text-pink-500 mt-6 w-fit"
                href="{{ route('post.view', ['id'=> $post->id])}}"
                >Read more
                <!-- <x-icons.arrow-sm-right class="text-xs" /> -->
            </a>
            <!-- <form
                action="{{route('post.delete', ['id'=>$post->id])}}"
                method="post"
            >
                @csrf @method('DELETE')
                <button
                    type="submit"
                    onclick="return confirm('Sure want to delete?')"
                    class="btn btn-error btn-xs"
                >
                    delete
                </button>
            </form> -->
        </div>
    </div>
</div>
