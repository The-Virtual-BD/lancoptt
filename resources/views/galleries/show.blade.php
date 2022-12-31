<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ __('All Gallery') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-md shadow p-6 flex items-center justify-between">
            <h1 class="font-bold text-2xl">{{$gallery->category->name}}</h1>
            <a href="{{route('galleries.edit', $gallery->id)}}" class="flex items-center justify-center py-2 px-4 rounded text-gray-800 hover:text-orange-300 bg-orange-300 hover:bg-gray-800"><span class="iconify mr-2" data-icon="material-symbols:image-rounded"></span>Manage Image</a>
        </div>
        <div class="p-6 bg-white rounded-md shadow mt-6 grid grid-cols-2 sm:grid-cols-3 gap-2">
            @foreach ($gallery->media as $media)
            <div class="">
                <img src="{{$media->original_url}}" alt="" srcset="">
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
