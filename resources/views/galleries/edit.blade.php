<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
                {{ __('All Gallery') }}
            </x-nav-link>
        </div>
    </x-slot>
    {{-- File pond stylesheet --}}
    <x-slot name="headerstyle">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded-md shadow p-6">
            <h1 class="font-bold text-2xl">{{$gallery->category->name}}</h1>
        </div>
        <div class=" ">
            <form method="POST" action="{{ route('galleries.update',$gallery->id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <!-- Image Preview -->
                <div class="mt-4">
                </div>
                <div class="mt-4">
                    <input id="image" name="image[]" multiple="true" type="file" class="">
                </div>

                <div class="flex items-center justify-end mt-4 pt-4">
                    <x-primary-button class="">
                        {{ __('Add Image') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="p-6 bg-white rounded-md shadow mt-6 grid grid-cols-2 sm:grid-cols-3 gap-2">
            @foreach ($gallery->media as $media)
            <div class="relative group">
                <img src="{{$media->original_url}}" alt="" srcset="">
                <form action="{{route('mediaDelete',[$gallery->id,$media->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="absolute hidden group-hover:block right-2.5 top-2.5 text-xl text-orange-300 hover:text-red-500 px-1 py-1 rounded bg-gray-300/40 hover:bg-gray-800"><span class="iconify" data-icon="bi:trash-fill"></button>
                </form>
            </div>
            @endforeach
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
