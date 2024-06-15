<nav class="w-full py-10 p-4 text-white mb-3">
    <div
        class="w-full container mx-auto max-w-5xl flex justify-between items-center"
    >
        <a class="" href="{{ route('welcome') }}">
            <h1 class="text-xl md:text-3xl font-semibold">Blog Verse</h1>
        </a>

        <ul class="hidden sm:flex gap-5 justify-center text-sm">
            <li>
                <a class="link link-hover" href="{{ route('welcome') }}"
                    >Blogs</a
                >
            </li>
            @if(!auth()->user())
            <li>
                <a class="link link-hover" href="{{ route('login') }}">Login</a>
            </li>
            @endif
            <li>
                <a class="link link-hover" href="{{ route('about') }}">About</a>
            </li>

            @if(auth()->user())
            <li>
                <a class="link link-hover" href="{{ route('profile.edit') }}"
                    >Profile</a
                >
            </li>
            @endif @if(auth()->user())
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="link link-hover">logout</button>
            </form>
            @endif
        </ul>

        <div class="flex sm:hidden">
            <button class="btn btn-ghost">
                <x-icons.menu class="w-7 h-7" />
            </button>
        </div>
    </div>
</nav>
