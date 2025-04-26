<x-app-layout>
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-md rounded-lg mx-auto">
            <div class="bg-gray-100 p-4 flex justify-between items-center">
                <h1 class="text-3xl font-bold">Laporan</h1>
            </div>
            <div class="bg-gray-100 p-4 flex justify-between items-center">
                <div class="w-full mt-2">
                    <form action="{{ route('laporan.list') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                        <!-- Input No Kontrol -->
                        <div class="relative">
                            <input type="text" name="no_kontrol" placeholder="Cari NoKontrol"
                                value="{{ request('no_kontrol') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md pr-10 focus:ring focus:ring-blue-200">
                            <svg class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 15l5 5m-5-5a7 7 0 1 0-10 0 7 7 0 0 0 10 0z" />
                            </svg>
                        </div>

                        <!-- Bulan -->
                        <select name="bulan" class="px-3 py-2 border rounded-md">
                            <option value="">Semua Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>

                        <!-- Tahun -->
                        <select name="tahun" class="px-3 py-2 border rounded-md">
                            <option value="">Semua Tahun</option>
                            @for ($year = now()->year; $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>

                        <!-- Filter Status -->
                        <select name="status" class="px-3 py-2 border rounded-md">
                            <option value="">Semua Status</option>
                            <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Belum Bayar" {{ request('status') == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        </select>

                        <!-- Tombol Filter -->
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">
                            Filter
                        </button>

                        <!-- Tombol Export PDF -->
                        <a href="{{ route('laporan.exportpdf', ['bulan' => request('bulan'), 'tahun' => request('tahun'), 'status' => request('status')]) }}"
                            target="_blank"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center gap-2 transition">
                            <i class="fas fa-file-pdf"></i>
                            Export PDF
                        </a>
                    </form>
                </div>
            </div>

            <div class="p-6 w-full overflow-x-auto">
                @if ($pemakaians->isEmpty())
                    <div class="text-center text-gray-500 mt-4">
                        <img src="{{ asset('asset/data-kosong.jpg') }}" alt="Data Kosong"
                            class="mx-auto mt-2 w-64 h-auto">
                    </div>
                @else
                <table class="table-auto w-full divide-y divide-gray-200 mx-auto">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pakai (kWh)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Beban (Rp)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Pemakaian (Rp)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pemakaians as $index => $pemakaian)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pemakaian->Tahun }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::createFromFormat('m', $pemakaian->Bulan)->translatedFormat('F') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pemakaian->NoKontrol }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pemakaian->JumlahPakai }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($pemakaian->BiayaBebanPemakai, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($pemakaian->BiayaPemakaian, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($pemakaian->Status == 'Lunas')
                                        <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-full">Lunas</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-200 rounded-full">Belum Bayar</span>
                                    @endif
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
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>
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
                    window.location.href = "{{ route('laporan.list') }}"; // Reload ke halaman awal
                }
            });
        });
    </script>
</x-app-layout>
