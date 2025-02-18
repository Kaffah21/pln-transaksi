<x-app-layout>
    @section('content')
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-5">
                        <h3 class="text-2xl font-semibold text-gray-800">Edit Pemakaian Listrik</h3>
                    </div>
                    <div class="p-6">
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pemakaian.update', $pemakaian->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-5">
                                <label for="NoKontrol" class="block text-gray-700 font-medium mb-2">Pelanggan</label>
                                <select name="NoKontrol" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @foreach($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->NoKontrol }}" {{ $pemakaian->NoKontrol == $pelanggan->NoKontrol ? 'selected' : '' }}>
                                            {{ $pelanggan->Nama }} - {{ $pelanggan->NoKontrol }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="Tahun" class="block text-gray-700 font-medium mb-2">Tahun</label>
                                <select name="Tahun" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @for ($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}" {{ $pemakaian->Tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="Bulan" class="block text-gray-700 font-medium mb-2">Bulan</label>
                                <select name="Bulan" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}" {{ $pemakaian->Bulan == $month ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="MeterAwal" class="block text-gray-700 font-medium mb-2">Meter Awal</label>
                                <input type="number" name="MeterAwal" id="MeterAwal" required value="{{ $pemakaian->MeterAwal }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-5">
                                <label for="MeterAkhir" class="block text-gray-700 font-medium mb-2">Meter Akhir</label>
                                <input type="number" name="MeterAkhir" id="MeterAkhir" required value="{{ $pemakaian->MeterAkhir }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-5">
                                <label for="JumlahPakai" class="block text-gray-700 font-medium mb-2">Jumlah Pakai</label>
                                <input type="number" name="JumlahPakai" id="JumlahPakai" readonly value="{{ $pemakaian->JumlahPakai }}"
                                    class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg shadow-sm">
                            </div>

                            <div class="mb-5">
                                <label for="BiayaBebanPemakai" class="block text-gray-700 font-medium mb-2">Biaya Beban</label>
                                <input type="number" step="0.01" name="BiayaBebanPemakai" required value="{{ $pemakaian->BiayaBebanPemakai }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-5">
                                <label for="BiayaPemakaian" class="block text-gray-700 font-medium mb-2">Biaya Pemakaian</label>
                                <input type="number" step="0.01" name="BiayaPemakaian" required value="{{ $pemakaian->BiayaPemakaian }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="flex justify-between mt-6">
                                <a href="{{ route('pemakaian.index') }}"
                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-300 ease-in-out transform hover:scale-105">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const meterAwal = document.getElementById('MeterAwal');
                const meterAkhir = document.getElementById('MeterAkhir');
                const jumlahPakai = document.getElementById('JumlahPakai');

                function hitungJumlahPakai() {
                    const awal = parseFloat(meterAwal.value) || 0;
                    const akhir = parseFloat(meterAkhir.value) || 0;
                    const hasil = akhir - awal;
                    jumlahPakai.value = hasil > 0 ? hasil : 0;
                }

                meterAwal.addEventListener('input', hitungJumlahPakai);
                meterAkhir.addEventListener('input', hitungJumlahPakai);
            });
        </script>
    @endsection
</x-app-layout>
