<nav class="w-full py-10 p-4 text-white mb-3">
    <div
        class="w-full container mx-auto max-w-5xl flex justify-between items-center"
    >
        <h1 class="text-xl md:text-3xl font-semibold">Blog Verse</h1>

        <ul class="hidden sm:flex gap-5 justify-center text-sm">
            <li>
                <a class="link link-hover" href="{{ route('welcome') }}"
                    >Blogs</a
                >
            </li>
            <li>
                <a class="link link-hover" href="{{ route('login') }}">Login</a>
            </li>

            <li>
                <a class="link link-hover" href="{{ route('create') }}"
                    >Create-Blog</a
                >
            </li>
            <li>
                <a class="link link-hover" href="{{ route('about') }}">About</a>
            </li>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="link link-hover">logout</button>
            </form>
        </ul>

        <div class="flex sm:hidden">
            <button class="btn btn-ghost">
                <x-icons.menu class="w-7 h-7" />
            </button>
        </div>
    </div>
</nav>
