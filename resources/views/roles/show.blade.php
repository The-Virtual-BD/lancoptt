<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                {{ __('All Roles') }}
            </x-nav-link>
            <x-nav-link :href="route('roles.create')" :active="request()->routeIs('roles.create')">
                {{ __('Add New Role') }}
            </x-nav-link>
        </div>
    </x-slot>

    @if (count($errors) > 0)
        <div class="p-6">
            <div class="text-red-500 bg-red-100 px-4 py-2">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="p-6">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div class="shadow sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="company-website" class="block text-sm font-medium text-gray-700">Role
                                Name:</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="company-website" id="company-website"
                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="New role name">
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <div class="text-base font-medium text-gray-900" aria-hidden="true">Permissions:</div>
                        <div class="mt-4 space-y-4">
                            @foreach ($permissions as $value)
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="" name="permission[]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" value="{{$value->id,}}">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="comments" class="font-medium text-gray-700">{{ $value->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
