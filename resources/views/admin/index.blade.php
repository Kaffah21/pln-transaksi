<x-app-layout>
    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="bg-gray-100 p-4 flex justify-between items-center">
                        <h1 class="text-3xl font-bold">Daftar Petugas Loket</h1>
                        <a href="{{ route('admin.petugas.create') }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                            <i class="fas fa-plus fs-2 mr-2"></i> Tambah Petugas
                        </a>
                    </div>

                    <div class="p-6">
                        @if (session('success'))
                            <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">{{ session('success') }}</div>
                        @endif

                        <table class="table-auto w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $user->role }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <div class="relative inline-block text-left">
                                                <button type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    data-dropdown-id="dropdown-{{ $user->id }}">
                                                    <i class="fas fa-ellipsis-v"></i> <!-- Icon titik 3 -->
                                                </button>

                                                <div id="dropdown-{{ $user->id }}"
                                                    class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="z-index: 50">
                                                    <div class="py-1" role="menu" aria-orientation="vertical"
                                                        aria-labelledby="options-menu">
                                                        <a href="{{ route('admin.petugas.edit', $user) }}"
                                                            class="text-gray-700 block px-4 py-2 text-sm"
                                                            role="menuitem">Edit</a>
                                                        <form action="{{ route('admin.petugas.destroy', $user) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-gray-700 block px-4 py-2 text-sm"
                                                                role="menuitem"
                                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- pagination --}}
                        {{-- <div>
                        {{ $users->links() }}
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButtons = document.querySelectorAll('[data-dropdown-id]');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetDropdownId = this.getAttribute('data-dropdown-id');
                    const targetDropdown = document.getElementById(targetDropdownId);

                    const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
                    allDropdowns.forEach(dropdown => {
                        if (dropdown.id !== targetDropdownId) {
                            dropdown.classList.add('hidden');
                        }
                    });

                    targetDropdown.classList.toggle('hidden');
                });
            });
        });
    </script>
</x-app-layout>
