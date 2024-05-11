@if ($errors->any())

<ul class="flex flex-col gap-4">
    @foreach ($errors->all() as $error)
    <li class="alert alert-error">
        {{ $error }}
        <x-icons.ban class="w-4" />
    </li>
    @endforeach
</ul>
@endif
