@props(['name'])

@error($name)
    <span class="text-ts text-red-500">{{ $message }}</span>
@enderror