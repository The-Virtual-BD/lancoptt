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

    <div class="p-6">
        <table id="userTable" class="display stripe" style="width:100%">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Gurd Name</th>
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
                    ajax: "{!! route('roles.index') !!}",
                    columns: [
                        {"render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'guard_name',
                            name: 'guard_name'
                        },
                        {
                            data: null,
                            render: function(data) {
                                return `<div class="flex"><a href="${BASE_URL}roles/${data.id}/edit" class="bg-green-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-green-700" ><span class="iconify" data-icon="dashicons:edit"></span></a>
                                <button type="button"  class="bg-red-600 rounded-md text-white py-2 px-2 mx-1 hover:bg-red-700" onclick="roleDelete(${data.id});"><span class="iconify" data-icon="bi:trash-fill"></span></button></div>`;
                            }
                        }
                    ]
                });


            function roleDelete(permissionID) {
                Swal.fire({
                    title: "Delete ?",
                    text: "Are you sure to delete this Role ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'DELETE',
                            url: BASE_URL +'roles/'+permissionID,
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
