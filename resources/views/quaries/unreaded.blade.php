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
        <table id="quaryTable" class="display stripe" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#quaryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('quaries.unreaded') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: null,
                        render: function (data) {
                            if (data.status == 1){
                                var statusLabels = '<span  class="bg-green-500 rounded-full text-white text-sm px-2 inline-block py-1"><span class="iconify" data-icon="ic:outline-email"></span></span>';
                            }else{
                                var statusLabels = '<span  class="bg-orange-300 rounded-full text-gray-800 text-sm px-2 inline-block py-1"><span class="iconify" data-icon="mdi:email-open-outline"></span></span>';
                            }

                            return statusLabels;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div class="flex"><a href="${BASE_URL}quaries/read/${data.id}" class="bg-blue-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-blue-700" ><span class="iconify" data-icon="ic:baseline-remove-red-eye"></span></a><button type="button"  class="bg-blue-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-blue-700" onclick="readUnreadQuary(${data.id},${data.status});"><span class="iconify" data-icon="zondicons:reload"></span></button><button type="button"  class="bg-red-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-700" onclick="quaryDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                        }
                    }
                ]
            });


            function quaryDelete(quaryID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to detede this message ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL + 'quaries/delete/' + quaryID,
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
            function readUnreadQuary(quaryID,status) {
                var message = ((status == 1?"Readed":"Unreaded"));
                var updateStatus = ((status == 1?2:1));
                Swal.fire({
                    title: " "+message+"?",
                    text: "Do you want to mark this message as "+message+" ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'PATCH',
                            url: BASE_URL +'quaries/toggle/'+quaryID,
                            data: {
                                quaryID: quaryID,
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
