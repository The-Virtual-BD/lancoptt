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
        <form method="POST" action="{{ route('newsletters.store') }}">
            @csrf

            <!-- Body -->
            <div class="mt-4">
                <x-input-label for="body" :value="__('Newsletter text')" />
                <textarea class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    name="body" id="body" rows="5" required></textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Compose Newsletter') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div class="p-6">
        <table id="userTable" class="display stripe" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Text</th>
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
                ajax: "{!! route('newsletters.index') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'text',
                        name: 'text'
                    },
                    {
                        data: null,
                        render: function(data) {
                            if (data.status == 1) {
                                var statusLabels =
                                    '<span  class="bg-green-500 rounded-full text-white text-sm px-2"> Unsent </span>';
                            } else {
                                var statusLabels =
                                    '<span  class="bg-orange-300 rounded-full text-gray-800 text-sm px-2"> Sent</span>';
                            }

                            return statusLabels;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div class="flex"><a href="${BASE_URL}newsletters/show/${data.id}" target="_blank" class="bg-blue-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-blue-700" ><span class="iconify" data-icon="ic:baseline-remove-red-eye"></span></a><button type="button"  class="bg-blue-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-blue-700" onclick="newsletterSend(${data.id});"><span class="iconify" data-icon="material-symbols:send-rounded"></span></button>
                                <button type="button"  class="bg-red-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-700" onclick="subscriberDelete(${data.id});"><span class="iconify" data-icon="bi:trash"></span></button></div>`;
                        }
                    }
                ]
            });


            function subscriberDelete(subscriberID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this newsletter ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL + 'newsletters/delete/' + subscriberID,
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

            // Newsletter send
            function newsletterSend(subscriberID) {
                Swal.fire({
                    title: " Send ?",
                    text: "Do you want to send this Newsletter ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Send",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: BASE_URL + 'newsletters/send/' + subscriberID,
                            success: function(response) {
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
