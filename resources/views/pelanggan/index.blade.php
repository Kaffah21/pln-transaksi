<x-app-layout>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="bg-gray-100 p-4 flex justify-between items-center">
                    <h1 class="text-3xl font-bold">Daftar Pelanggan</h1>
                    <a href="{{ route('pelanggan.create') }}" class="text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center" style="background: #07acea">
                        <i class="fas fa-plus fs-2 mr-2"></i> Tambah Pelanggan
                    </a>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">{{ session('success') }}</div>
                    @endif

                    @if ($pelanggans->isEmpty())
                        <div class="text-center text-gray-500 mt-4">
                            <img src="{{ asset('asset/data-kosong.jpg') }}" alt="Data Kosong"
                                class="mx-auto mt-2 w-64 h-auto">
                        </div>
                    @else
                        <table class="table-auto w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pelanggans as $pelanggan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->NoKontrol }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->Nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->Alamat }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->Telepon }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->tarif->Jenis_Plg ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            <div class="relative inline-block text-left">
                                                <button type="button" class="p-2 bg-white border-none rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none" data-dropdown-id="dropdown-{{ $pelanggan->NoKontrol }}">
                                                    <i class="fas fa-ellipsis-v"></i> <!-- Icon titik 3 -->
                                                </button>

                                                <div id="dropdown-{{ $pelanggan->NoKontrol }}" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                                        <a href="{{ route('pelanggan.edit', $pelanggan->NoKontrol) }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem">Edit</a>
                                                        <form action="{{ route('pelanggan.destroy', $pelanggan->NoKontrol) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 block px-4 py-2 text-sm" role="menuitem" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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
                            {{ $pelanggans->links() }}
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
       document.addEventListener("DOMContentLoaded", function() {
            const dropdownButtons = document.querySelectorAll('[data-dropdown-id]');
            let activeDropdown = null;

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation(); // Mencegah event dari bubbling ke document

                    const targetDropdownId = this.getAttribute('data-dropdown-id');
                    const targetDropdown = document.getElementById(targetDropdownId);

                    // Tutup semua dropdown sebelum membuka yang baru
                    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                        if (dropdown !== targetDropdown) {
                            dropdown.classList.add('hidden');
                        }
                    });

                    // Toggle visibility dropdown yang diklik
                    const isHidden = targetDropdown.classList.contains('hidden');
                    targetDropdown.classList.toggle('hidden', !isHidden);

                    // Simpan referensi dropdown aktif
                    activeDropdown = isHidden ? targetDropdown : null;
                });
            });

            // Menutup dropdown saat klik di luar
            document.addEventListener('click', function(event) {
                if (activeDropdown && !event.target.closest('[data-dropdown-id]') && !event.target.closest('[id^="dropdown-"]')) {
                    activeDropdown.classList.add('hidden');
                    activeDropdown = null;
                }
            });
        });
    </script>
</x-app-layout>
