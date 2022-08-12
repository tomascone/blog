<x-dropdown>
    <x-slot name="trigger">      
        <button class="bg-transparent py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 flex lg:inline-flex">

            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

            <x-icon class="absolute pointer-events-none" style="right: 12px;" name="down-arrow">

            </x-icon>

        </button>
    </x-slot>

    <x-dropdown-item href="/" :active="request()->routeIs('home')">
        All
    </x-dropdown-item>

    @foreach ($categories as $category)
        <x-dropdown-item href="?category={{ $category->slug }}" :active='request()->is("categories/{$category->slug}")'>
            {{ ucwords($category->name) }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>