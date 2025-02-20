<x-app-layout>
    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="bg-gray-100 p-4 flex justify-between items-center">
                        <h1 class="text-3xl font-bold">Daftar Pemakaian</h1>

                        <div class="flex space-x-4">
                            <!-- Form Filter NoKontrol -->
                            <form action="{{ route('pemakaian.index') }}" method="GET" class="flex space-x-4 items-center">
                                <div class="relative">
                                    <input type="text" name="no_kontrol" placeholder="Cari NoKontrol"
                                        value="{{ request('no_kontrol') }}"
                                        class="px-4 py-2 border border-gray-300 rounded-md pr-10 focus:ring focus:ring-blue-200">
                                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l5 5m-5-5a7 7 0 1 0-10 0 7 7 0 0 0 10 0z" />
                                    </svg>
                                </div>
                                {{-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                                    Cari
                                </button> --}}
                            </form>

                            <!-- Tombol Tambah -->
                            <a href="{{ route('pemakaian.create') }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                            <i class="fas fa-plus fs-2 mr-2"></i> Tambah Pemakaian
                            </a>
                        </div>

                    </div>

                    <div class="p-6">


                        @if ($pemakaians->isEmpty())
                            <div class="text-center text-gray-500 mt-4">
                                <img src="{{ asset('asset/data-kosong.jpg') }}" alt="Data Kosong"
                                    class="mx-auto mt-2 w-64 h-auto">
                            </div>
                        @else
                            <table class="table-auto w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tahun</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bulan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No Kontrol</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah Pakai (kWh)</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Biaya Beban (Rp)</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Biaya Pemakaian (Rp)</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>

                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($pemakaians as $index => $pemakaian)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pemakaian->Tahun }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                {{ \Carbon\Carbon::createFromFormat('m', $pemakaian->Bulan)->translatedFormat('F') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                {{ $pemakaian->NoKontrol }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                {{ $pemakaian->JumlahPakai }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp
                                                {{ number_format($pemakaian->BiayaBebanPemakai, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp
                                                {{ number_format($pemakaian->BiayaPemakaian, 2, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    @if ($pemakaian->Status == 'Lunas')
                                                        <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-full">Lunas</span>
                                                    @else
                                                        <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-200 rounded-full">Belum Lunas</span>
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                    <div class="relative inline-block text-left">
                                                        <button type="button"
                                                            class="inline-flex justify-center w-full rounded-md bg-white px-2 py-1 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none"
                                                            data-dropdown-id="dropdown-{{ $pemakaian->id }}">
                                                            <i class="fas fa-ellipsis-v"></i> <!-- Icon titik 3 tanpa border -->
                                                        </button>

                                                        <div id="dropdown-{{ $pemakaian->id }}"
                                                            class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                            style="z-index:50;">
                                                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                                                <a href="{{ route('pemakaian.edit', $pemakaian) }}"
                                                                    class="text-gray-700 block px-4 py-2 text-sm" role="menuitem">Edit</a>

                                                                <form action="{{ route('pemakaian.destroy', $pemakaian) }}" method="POST"
                                                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem">Hapus</button>
                                                                </form>

                                                                <!-- Add Update Status Option -->
                                                                <form action="{{ route('pemakaian.update-status', $pemakaian) }}" method="POST" class="inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="text-gray-700 block px-4 py-2 text-sm"
                                                                        role="menuitem">
                                                                        {{ $pemakaian->status == 'Lunas' ? ' Belum Bayar' : ' Lunas' }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Pagination --}}
                        <div>{{ $pemakaians->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownButtons = document.querySelectorAll('[data-dropdown-id]');
            const searchInput = document.querySelector('input[name="no_kontrol"]');


            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const targetDropdownId = this.getAttribute('data-dropdown-id');
                    const targetDropdown = document.getElementById(targetDropdownId);

                    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                        if (dropdown.id !== targetDropdownId) {
                            dropdown.classList.add('hidden');
                        }
                    });

                    targetDropdown.classList.toggle('hidden');
                });
            });

            document.addEventListener('click', function() {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            });
            searchInput.addEventListener("input", function() {
            if (this.value === "") {
                window.location.href = "{{ route('pemakaian.index') }}"; // Reload ke halaman awal
            }
        });
        });
    </script>
</x-app-layout>
