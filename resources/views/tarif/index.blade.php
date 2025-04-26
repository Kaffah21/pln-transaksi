<x-app-layout>
    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="bg-gray-100 p-4 flex justify-between items-center">
                        <h1 class="text-3xl font-bold">Jenis Tarif Pelanggan</h1>
                        <a href="{{ route('tarif.create') }}"
                            class="text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center" style="background: #07acea">
                            <i class="fas fa-plus fs-2 mr-2"></i> Tambah Jenis Pelanggan
                        </a>
                    </div>

                    <div class="p-6">
                        @if (session('success'))
                            <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">{{ session('success') }}</div>
                        @endif

                        @if ($tarifs->isEmpty())
                            <div class="text-center text-gray-500 mt-4">
                                <img src="{{ asset('asset/data-kosong.jpg') }}" alt="Data Kosong"
                                    class="mx-auto mt-2 w-64 h-auto">
                            </div>
                        @else
                            <table class="table-auto w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pelanggan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Beban (Rp)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif per KWh (VA)</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tarifs as $index => $tarif)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ ($tarifs->currentPage() - 1) * $tarifs->perPage() + $loop->iteration }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $tarif->Jenis_Plg }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp
                                                {{ number_format($tarif->BiayaBeban, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                {{ number_format($tarif->TarifKWH) }} VA</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                <div class="relative inline-block text-left">
                                                    <button type="button"
                                                        class="inline-flex justify-center w-full rounded-md bg-white px-2 py-1 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none"
                                                        data-dropdown-id="dropdown-{{ $tarif->id }}">
                                                        <i class="fas fa-ellipsis-v"></i> <!-- Icon titik 3 tanpa border -->
                                                    </button>

                                                    <div id="dropdown-{{ $tarif->id }}"
                                                        class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        style="z-index:10;">
                                                        <div class="py-1" role="menu" aria-orientation="vertical"
                                                            aria-labelledby="options-menu">
                                                            <a href="{{ route('tarif.edit', $tarif) }}"
                                                                class="text-gray-700 block px-4 py-2 text-sm"
                                                                role="menuitem">Edit</a>
                                                            {{-- <form action="{{ route('tarif.destroy', $tarif) }}" method="POST"
                                                                class="inline" id="delete-form-{{ $tarif->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" 
                                                                    class="text-red-500 block px-4 py-2 text-sm"
                                                                    role="menuitem"
                                                                    onclick="showConfirmModal({{ $tarif->id }})">Hapus</button>
                                                            </form> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- pagination --}}
                            <div class="mt-4">
                                {{ $tarifs->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Modal Alert -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h3>
            <p class="text-sm mb-4">Data ini sedang digunakan di beberapa tempat, jika dihapus akan menyebabkan error. Apakah Anda yakin ingin melanjutkan penghapusan?</p>
            <div class="flex justify-center space-x-4">
                <button id="confirmDeleteBtn" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Hapus</button>
                <button id="cancelDeleteBtn" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Batal</button>
            </div>
        </div>
    </div>

    <script>
        let tarifIdToDelete = null;

        function showConfirmModal(tarifId) {
            tarifIdToDelete = tarifId;
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        document.getElementById('cancelDeleteBtn').addEventListener('click', function() {
            document.getElementById('confirmModal').classList.add('hidden');
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (tarifIdToDelete !== null) {
                // Submit the form to delete the data
                document.getElementById('delete-form-' + tarifIdToDelete).submit();
                document.getElementById('confirmModal').classList.add('hidden');
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButtons = document.querySelectorAll('[data-dropdown-id]');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const targetDropdownId = this.getAttribute('data-dropdown-id');
                    const targetDropdown = document.getElementById(targetDropdownId);

                    // Close other dropdowns
                    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                        if (dropdown.id !== targetDropdownId) {
                            dropdown.classList.add('hidden');
                        }
                    });

                    targetDropdown.classList.toggle('hidden');
                });
            });

            // Close dropdowns if clicked outside
            document.addEventListener('click', function() {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            });
        });
    </script>
</x-app-layout>
