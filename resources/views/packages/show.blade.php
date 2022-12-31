<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                {{ __('All Packages') }}
            </x-nav-link>
            <x-nav-link :href="route('packages.create')" :active="request()->routeIs('packages.create')">
                {{ __('New Package') }}
            </x-nav-link>
        </div>
    </x-slot>

    <x-slot name="headerstyle">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    </x-slot>
    <x-slot name="headerscript">
        <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-md shadow p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <form method="POST" action="{{ route('packages.update', $package->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />

                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            value="{{ $package->title }}" required autofocus />

                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>


                    <!-- Price -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />

                        <x-text-input id="price" class="block mt-1 w-full onlynumber" type="text" name="price" value="{{ $package->price }}"
                            required />

                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    {{-- Image --}}
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Package Image (416x416)')" />
                        <input id="image" name="image[]" multiple="false" type="file" class="">
                    </div>

                    <!-- Body -->
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Body text')" />
                        <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name="body" id="body" rows="5" required>{{ $package->body }}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Update Package') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="hidden sm:block bg-orange-300">
                <img src="{{ $package->media->first()->original_url }}" alt="" srcset="">
                <div class="p-4">

                    <h2 class="text-center font-bold uppercase text-2xl">{{ $package->title }}</h2>
                    <p class="text-center font-bold text-4xl flex justify-center items-center"><span class="iconify"
                            data-icon="tabler:currency-taka"></span> {{ $package->price }}/=</p>
                    <p class="mt-4 text-justify">{!! $package->body !!}</p>
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
            FilePond.create(document.querySelector('input[name="image[]"]'), {
                chunkUploads: true
            });
            FilePond.setOptions({
                server: {
                    url: '/galaryupload',
                    headers: {
                        'X-CSRF-TOKEN': "{{ @csrf_token() }}",
                    }
                }
            });

            // CKEditor 4
            CKEDITOR.replace('body');
        </script>
    </x-slot>


</x-app-layout>
