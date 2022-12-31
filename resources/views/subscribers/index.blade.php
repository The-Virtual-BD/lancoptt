<x-app-layout>
    <x-slot name="submenu">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('subscribers.index')" :active="request()->routeIs('subscribers.index')">
                {{ __('All Subscribers') }}
            </x-nav-link>
            <x-nav-link :href="route('newsletters.index')" :active="request()->routeIs('newsletters.index')">
                {{ __('News Letters') }}
            </x-nav-link>
        </div>
    </x-slot>
    <div class="p-6 ">
        <form method="POST" action="{{ route('subscribers.store') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="name" :value="__('Subscriber Email')" />

                <x-text-input id="name" class="block mt-1 w-full" type="email" name="email" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Add Subscriber') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="p-6">
        <table id="userTable" class="display stripe" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('subscribers.index') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: null,
                        render: function (data) {
                            if (data.status == 1){
                                var statusLabels = '<span  class="bg-green-500 rounded-full text-white text-sm px-2"> Active </span>';
                            }else{
                                var statusLabels = '<span  class="bg-orange-300 rounded-full text-gray-800 text-sm px-2"> In-Active </span>';
                            }

                            return statusLabels;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div class="flex"><button type="button"  class="bg-blue-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-blue-700" onclick="activateDeactivateSubscriber(${data.id},${data.status});"><span class="iconify" data-icon="zondicons:reload"></span></button>
                                <button type="button"  class="bg-red-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-700" onclick="subscriberDelete(${data.id});"><span class="iconify" data-icon="majesticons:logout"></span></button></div>`;
                        }
                    }
                ]
            });


            function subscriberDelete(subscriberID) {
                Swal.fire({
                    title: "Unsubscribe ?",
                    text: "Are you sure to unsubscribe this email ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Unsubscribe",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL + 'subscribers/' + subscriberID,
                            success: function(response) {
                                if (response.status == "success") {
                                    Swal.fire('Success!', response.message, 'success');
                                    datatablelist.draw();
                                } else if (response.status == "error") {
                                    Swal.fire('This item is not deletable!', response.message, 'error');
                                    datatablelist.draw();
                                }
                            }
                        });
                    }
                });
            }

            // Changing Status
            function activateDeactivateSubscriber(subscriberID,status) {
                var message = ((status == 1?"De-activate":"Activate"));
                var updateStatus = ((status == 1?2:1));
                Swal.fire({
                    title: " "+message+"?",
                    text: "Do you want to "+message+" this Subscriber ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'PATCH',
                            url: BASE_URL +'subscribers/'+subscriberID,
                            data: {
                                subscriberID: subscriberID,
                                updateStatus: updateStatus,
                            },
                            success: function (response) {
                                if (response.status == "success") {
                                    Swal.fire('Success!', response.message, 'success');
                                    datatablelist.draw();
                                }
                            }
                        });
                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>
