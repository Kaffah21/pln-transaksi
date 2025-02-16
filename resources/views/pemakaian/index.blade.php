<x-app-layout>
    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="bg-gray-100 p-4 flex justify-between items-center">
                        <h1 class="text-3xl font-bold">Daftar Pemakaian</h1>

                        <!-- Form Filter NoKontrol (untuk pelanggan) -->
                        <form action="{{ route('pemakaian.index') }}" method="GET" class="flex space-x-4">
                            <input type="text" name="no_kontrol" placeholder="Masukkan NoKontrol"
                                value="{{ request('no_kontrol') }}" class="px-4 py-2 border border-gray-300 rounded-md">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Cari
                            </button>
                        </form>
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
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pemakaian->Bulan }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                {{ $pemakaian->NoKontrol }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                {{ $pemakaian->JumlahPakai }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp
                                                {{ number_format($pemakaian->BiayaBebanPemakai, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp
                                                {{ number_format($pemakaian->BiayaPemakaian, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                                <a href="{{ route('pemakaian.edit', $pemakaian) }}"
                                                    class="text-blue-500">Edit</a>
                                                <form action="{{ route('pemakaian.destroy', $pemakaian) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 ml-2"
                                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Pagination --}}
                        {{-- <div>{{ $pemakaians->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
