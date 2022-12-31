<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('galleries.index')" :active="request()->routeIs('galleries.index')">
                    {{ __('All Gallaries') }}
                </x-nav-link>
                <x-nav-link :href="route('galleries.create')" :active="request()->routeIs('galleries.create')">
                    {{ __('Add New Gallery') }}
                </x-nav-link>
            </div>
        </div>
    </x-slot>

    <x-slot name="headerstyle">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    </x-slot>

    <div class="p-6 ">
        <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <div class="flex gap-4 items-center">

                    <select id="category_id" name="category_id" class="grow mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm">
                        @foreach ($categories as $item)

                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <a href="{{route('categories.index')}}" class="bg-gray-800 text-orange-300 hover:bg-orange-300 hover:text-gray-800 flex justify-center items-center w-[38px] h-[38px] rounded"><span class="iconify" data-icon="material-symbols:add"></span></a>
                </div>
            </div>

            <!-- Image Preview -->
            <div class="mt-4">
            </div>
            <div class="mt-4">
                <input id="image" name="image[]" multiple="true" type="file" class="">
            </div>

            <div class="flex items-center justify-end mt-4 pt-4">
                <x-primary-button class="">
                    {{ __('Save Galleries') }}
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

        </script>
    </x-slot>

</x-app-layout>
