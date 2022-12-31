<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ __('All Users') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-md shadow p-6">
            <h1 class="font-bold text-2xl">{{$category->name}}</h1>
        </div>
    </div>

    <div class="p-6 pt-0">
        <div class="bg-white rounded-md shadow p-6">
            @foreach ($category->galleries as $gallery)


            <div class="grid grid-cols-2 sm:grid-cols-4 mb-6 gap-2">
                @foreach ($gallery->media as $item)
                <img src="{{$item->getUrl()}}" alt="Image not Found" srcset="">
                @endforeach
            </div>
            @endforeach
        </div>
    </div>


</x-app-layout>
