<x-app-layout>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="bg-gray-100 p-4 flex justify-between items-center">
                    <h1 class="text-3xl font-bold">Daftar petugas</h1>
                    <a href="{{ route('admin.petugas.create') }}" class="text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center" style="background: #07acea">
                        <i class="fas fa-plus fs-2 mr-2"></i> Tambah petugas
                    </a>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">{{ session('success') }}</div>
                    @endif

                    @if ($users->isEmpty())
                        <div class="text-center text-gray-500 mt-4">
                            {{-- <img src="{{ asset('asset/data-kosong.jpg') }}" alt="Data Kosong"
                                class="mx-auto mt-2 w-64 h-auto"> --}}
                                <h3>Data kosong</h3>
                        </div>
                    @else
                        <table class="table-auto w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $index =>$petugas)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $loop -> iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $petugas->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $petugas->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $petugas->role }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <div class="relative inline-block text-left">
                                                <!-- Tombol titik tiga -->
                                                <button type="button"
                                                    class="p-2 bg-white border-none rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none"
                                                    data-dropdown-id="dropdown-{{ $petugas->id }}">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                        
                                                <!-- Dropdown menu -->
                                                <div id="dropdown-{{ $petugas->id }}"
                                                    class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                                        <a href="{{ route('admin.petugas.edit', $petugas->id) }}"
                                                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Edit</a>
                                                        <form action="{{ route('admin.petugas.destroy', $petugas->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-500 block w-full text-left px-4 py-2 text-sm hover:bg-red-100"
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

                        {{-- Pagination --}}
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownButtons = document.querySelectorAll('[data-dropdown-id]');
            let activeDropdown = null;

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const targetId = this.getAttribute('data-dropdown-id');
                    const targetDropdown = document.getElementById(targetId);

                    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                        if (dropdown !== targetDropdown) {
                            dropdown.classList.add('hidden');
                        }
                    });

                    const isHidden = targetDropdown.classList.contains('hidden');
                    targetDropdown.classList.toggle('hidden', !isHidden);

                    // Check if dropdown is near the bottom of the viewport
                    const rect = targetDropdown.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;
                    if (rect.bottom > viewportHeight) {
                        targetDropdown.style.bottom = '100%';
                        targetDropdown.style.top = 'auto';
                    } else {
                        targetDropdown.style.top = '100%';
                        targetDropdown.style.bottom = 'auto';
                    }

                    activeDropdown = isHidden ? targetDropdown : null;
                });
            });

            document.addEventListener('click', function () {
                if (activeDropdown) {
                    activeDropdown.classList.add('hidden');
                    activeDropdown = null;
                }
            });
        });
    </script>
    
</x-app-layout>