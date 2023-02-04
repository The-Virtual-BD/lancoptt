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
            <x-nav-link :href="route('cruiseOptions.index')" :active="request()->routeIs('cruiseOptions.index')">
                {{ __('All Options') }}
            </x-nav-link>
            <x-nav-link :href="route('cruiseOptions.create')" :active="request()->routeIs('cruiseOptions.create')">
                {{ __('New Option') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="p-6">
        <table id="packageTable" class="display stripe" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>


    <x-slot name="script">
        <script>
            var datatablelist = $('#packageTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('cruiseOptions.index') !!}",
                columns: [{
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `<div class="flex"><a href="${BASE_URL}cruiseOptions/${data.id}" class="bg-blue-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-blue-700" ><span class="iconify" data-icon="ic:baseline-remove-red-eye"></span></a><a href="${BASE_URL}cruiseOptions/${data.id}" class="bg-green-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-green-700" ><span class="iconify" data-icon="dashicons:edit"></span></a>
                                <button type="button"  class="bg-red-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-700" onclick="cruiseOptionDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                        }
                    }
                ]
            });


            function cruiseOptionDelete(cruiseOptionID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this packages Option ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL + 'cruiseOptions/' + cruiseOptionID,
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
        </script>
    </x-slot>
</x-app-layout>
