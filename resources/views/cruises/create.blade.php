<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('cruises.index')" :active="request()->routeIs('cruises.index')">
                {{ __('All Cruises') }}
            </x-nav-link>
            <x-nav-link :href="route('cruises.create')" :active="request()->routeIs('cruises.create')">
                {{ __('New Cruise') }}
            </x-nav-link>
        </div>
    </x-slot>

    <x-slot name="headerstyle">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    </x-slot>
    
    <x-slot name="headerscript">
        <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    </x-slot>

    <div class="p-6 ">
        <form method="POST" action="{{ route('cruises.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />

                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- Image --}}
            <div class="mt-4">
                <input id="image" name="image[]" multiple="false" type="file" class="">
            </div>

            <!-- Body -->
            <div class="mt-4">
                <x-input-label for="body" :value="__('Body text')" />
                <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="body" id="body" rows="5" required></textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Create Cruises') }}
                </x-primary-button>
            </div>
        </form>
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

            // CKEditor 4
            CKEDITOR.replace( 'body' );
        </script>
    </x-slot>
</x-app-layout>
