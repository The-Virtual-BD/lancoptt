<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('quaries.all')" :active="request()->routeIs('quaries.all')">
                {{ __('All Quaries') }}
            </x-nav-link>
            <x-nav-link :href="route('quaries.unreaded')" :active="request()->routeIs('quaries.unreaded')">
                {{ __('Unreaded Quaries') }}
            </x-nav-link>
            <x-nav-link :href="route('quaries.readed')" :active="request()->routeIs('quaries.readed')">
                {{ __('Readed Quaries') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="bg-white rounded p-6 shadow-md">
            <h1 class="font-bold">{{$query->name}}</h1>
            <p>Email: <span>{{$query->email}}</span></p>
            <p>Phone: <span>{{$query->phone}}</span></p>
            <p>Message: <span>{{$query->message}}</span></p>
        </div>
        <div class="bg-white rounded p-6 shadow-md mt-4">
            <form method="POST" action="{{ route('quaries.replay') }}">
                @csrf

                <!-- Your Replay -->
                <div>
                    <x-input-label for="message" :value="__('Your replay message')" />
                    <textarea class="block mt-1 w-full rounded" name="message" id="message" rows="10" required autofocus></textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>
                <input type="hidden" name="sender" value="{{$query->id}}">

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ URL::previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>

                    <x-primary-button class="ml-4">
                        {{ __('Replay') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


    <x-slot name="script">
        <script>

        </script>
    </x-slot>
</x-app-layout>
