<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ __('All Categories') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="p-6 ">
        <form method="POST" action="{{ route('categories.update',$category->id) }}">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$category->name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Update User') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
