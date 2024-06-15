<nav>
    <!-- Desktop Navigation -->
    <div class="hidden sm:flex w-full py-10 p-4 text-white mb-3">
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
                    <a class="link link-hover" href="{{ route('login') }}"
                        >Login</a
                    >
                </li>
                @endif
                <li>
                    <a class="link link-hover" href="{{ route('about') }}"
                        >About</a
                    >
                </li>

                @if(auth()->user())
                <li>
                    <a
                        class="link link-hover"
                        href="{{ route('profile.edit') }}"
                        >Profile</a
                    >
                </li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="link link-hover">
                        logout
                    </button>
                </form>
                @endif
            </ul>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="relative sm:hidden flex justify-between items-start text-white">
        <a href="{{ route('welcome') }}">
            <h1 class="text-xlp p-4 font-semibold">Blog Verse</h1>
        </a>

        <div class="relative">
            <button class="cursor-pointer p-4" wire:click="toggleMenu">
                <x-icons.menu class="w-7 h-7" />
            </button>

            @if ($isOpen)
            <div
                class="fixed top-0 right-0 bottom-0 flex justify-between items-start w-[50vw] min-h-lvh sm:hidden bg-slate-800"
            >
                <ul class="flex flex-col gap-10 mt-4 text-2xl px-4">
                    <li>
                        <a class="link link-hover" href="{{ route('welcome') }}"
                            >Blogs</a
                        >
                    </li>
                    @if(!auth()->user())
                    <li>
                        <a class="link link-hover" href="{{ route('login') }}"
                            >Login</a
                        >
                    </li>
                    @endif
                    <li>
                        <a class="link link-hover" href="{{ route('about') }}"
                            >About</a
                        >
                    </li>

                    @if(auth()->user())
                    <li>
                        <a
                            class="link link-hover"
                            href="{{ route('profile.edit') }}"
                            >Profile</a
                        >
                    </li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="link link-hover">
                            Logout
                        </button>
                    </form>
                    @endif
                </ul>

                <button class="cursor-pointer p-4" wire:click="toggleMenu">
                    <x-icons.x class="w-7 h-7" />
                </button>
            </div>
            @endif
        </div>
    </div>
</nav>
