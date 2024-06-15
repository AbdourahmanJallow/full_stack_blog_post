<div
    class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 place-content-start py-4 text-gray-500"
>
    <div class="flex flex-col justify-between overflow-hidden">
        <img src="{{$post->image}}" class="rounded-sm object-contain w-full" />
        <p class="mt-4 text-xs text-slate-300">
            {{ \Illuminate\Support\Carbon::parse($post->created_at)->format('F j, Y') }}
        </p>
    </div>
    <div class="lg:col-span-2 flex flex-col justify-between overflow-hidden">
        <div>
            <h2 class="text-white font-bold text-xl lg:text-3xl mb-5">
                {{$post->title}}
            </h2>
            <p class="text-slate-300">
                @if(strlen($post->content) < 200)
                {{ $post->content }}
                @else
                {{ substr($post->content, 0, 200) }}... @endif
            </p>
        </div>
        <div class="flex justify-between items-center">
            <div>
                <a
                    class="link link-hover text-pink-500 mt-6 w-fit"
                    href="{{ route('post.view', ['post'=> $post->slug])}}"
                    >Read more
                    <!-- <x-icons.arrow-sm-right class="text-xs" /> -->
                </a>
            </div>
            @if(request()->routeIs('profile.edit'))
            <div class="flex gap-2">
                <a href="{{route('post.edit', ['post'=> $post->slug])}}">
                    <button type="submit" class="btn btn-ghost btn-sm">
                        <x-icons.tag class="w-4 h-4 text-green-600" />
                    </button>
                </a>

                <form
                    action="{{route('post.delete', ['post'=>$post->slug])}}"
                    method="post"
                >
                    @csrf @method('DELETE')
                    <button
                        type="submit"
                        onclick="return confirm('Sure want to delete?')"
                        class="btn btn-ghost btn-sm"
                    >
                        <x-icons.trash class="w-4 h-4 text-[#C70000]" />
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
