<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')">
                {{ __('All Settings') }}
            </x-nav-link>
            <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')">
                {{ __('Frontend Settings') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="p-6">
    </div>


    <x-slot name="script">

    </x-slot>
</x-app-layout>
