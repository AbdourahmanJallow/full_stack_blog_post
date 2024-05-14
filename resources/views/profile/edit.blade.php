@extends('..layout.layout') @section('content')
<div class="">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 grid grid-cols-1"
    >
        <div class="sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-3xl md:text-5xl mb-4 text-pink-500">
                    My Profile
                </h1>

                @include('profile.partials.update-profile-image')
            </div>
            <div
                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
            >
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div
                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
            >
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div
                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
            >
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="">
                <h3 class="text-white text-3xl font-bold">My Blogs</h3>
                <div class="grid grid-cols-1 place-items-start">
                    @foreach($posts as $post) @include('..shared.post-card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
