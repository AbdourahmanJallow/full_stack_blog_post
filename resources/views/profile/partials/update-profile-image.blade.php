<!-- <div class="flex flex-col gap-3 justify-center">
    <form
        action="{{ route('profile.image.update') }}"
        method="post"
        enctype="multipart/form-data"
    >
        <div class="avatar">
            <div class="block group rounded-full w-32">
                <img
                    src="{{$user->profile_image}}"
                    alt="profile image"
                    class="absolute inset-0 object-cover rounded-full group-hover:opacity-50"
                />

                <div class="relative p-3 flex justify-center w-full h-full">
                    <div
                        class="transition-all transform translate-y-8 opacity-0 group-hover:opacity-100 group-hover:translate-y-0"
                    >
                        <div class="p-2 w-full h-full">
                            @csrf @method('POST')
                            <input name="profile_image" type="file" class="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <button type="submit" class="btn btn-ghost btn-xs">Save</button>
    <x-primary-button class="h-4">{{ __("Save") }}</x-primary-button>
</div> -->

<div class="flex flex-col gap-3 justify-center">
    <div class="avatar">
        <div class="block group rounded-full w-32">
            <img src="{{$user->profile_image}}" alt="profile image" />
        </div>
    </div>
</div>
