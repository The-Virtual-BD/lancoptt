<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('trades.index')" :active="request()->routeIs('trades.index')">
                {{ __('All Trades') }}
            </x-nav-link>
            <x-nav-link :href="route('trades.create')" :active="request()->routeIs('trades.create')">
                {{ __('New Trade') }}
            </x-nav-link>
        </div>
    </x-slot>

    <x-slot name="headerstyle">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-md shadow p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <form method="POST" action="{{ route('trades.update',$trade->id) }}" enctype="multipart/form-data" >
                    @csrf
                    @method('PATCH')
                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />

                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$trade->title}}" required autofocus />

                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Image --}}
                    <div class="mt-4">
                <x-input-label for="body" :value="__('Image (416x416)')" />

                        <input id="image" name="image[]" multiple="false" type="file" class="">
                    </div>

                    <!-- Body -->
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Body text')" />
                        <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="body" id="body" rows="5" required>{{$trade->body}}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Create Trades') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="hidden sm:block bg-orange-300">
                <img src="{{$trade->media->first()->original_url}}" alt="" srcset="">
                <div class="p-4">

                    <h2 class="text-center font-bold uppercase text-2xl">{{$trade->title}}</h2>
                    <p class="mt-4 text-justify">{{$trade->body}}</p>
                    <div class="flex justify-center mt-4">
                        <button class="text-center px-3 py-2 bg-gray-800 text-orange-300 ">Explore</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <!-- Load FilePond library -->
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <!-- Turn all file input elements into ponds -->
        <script>
            // Create the FilePond instance
            FilePond.create(document.querySelector('input[name="image[]"]'), {chunkUploads: true});
            FilePond.setOptions({
                server: {
                    url: '/galaryupload',
                    headers: {
                        'X-CSRF-TOKEN': "{{ @csrf_token() }}",
                    }
                }
            });
        </script>
    </x-slot>


</x-app-layout>
