@props(['name'])

<div class="mb-6">
    <x-form.label name="{{ $name }}" />

    <input 
        class="border border-gray-200 p-2 w-full rounded" 
        id="{{ $name }}" 
        name="{{ $name }}"
        value="{{ old($name) }}"
        required
        {{ $attributes }}
    >
    
    <x-form.error name="{{ $name }}" />
</div>