<x-app-layout>
    @section('content')
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-100 to-gray-200 p-5">
                        <h3 class="text-2xl font-semibold text-gray-800">Tambah Pemakaian Listrik</h3>
                    </div>
                    <div class="p-6">
                    @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                <strong class="font-bold">Ups!</strong>
                                <span class="block text-sm">Ada kesalahan saat input data:</span>
                            </div>
                        @endif
                        <form action="{{ route('pemakaian.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="NoKontrol" class="block text-gray-700 font-medium mb-2">Pelanggan</label>
                                    <select name="NoKontrol" id="NoKontrol" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach ($pelanggans as $pelanggan)
                                            <option value="{{ $pelanggan->NoKontrol }}"
                                                {{ old('NoKontrol') == $pelanggan->NoKontrol ? 'selected' : '' }}>
                                                {{ $pelanggan->Nama }} - {{ $pelanggan->NoKontrol }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="Tahun" class="block text-gray-700 font-medium mb-2">Tahun</label>
                                    <select name="Tahun" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        @for ($year = date('Y'); $year >= 2020; $year--)
                                            <option value="{{ $year }}"
                                                {{ old('Tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
                                    <label for="Bulan" class="block text-gray-700 font-medium mb-2">Bulan</label>
                                    <select name="Bulan" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}"
                                                {{ old('Bulan') == $month ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
                                    <label for="MeterAwal" class="block text-gray-700 font-medium mb-2">Meter Awal</label>
                                    <input type="number" name="MeterAwal" id="MeterAwal" required readonly>
                                </div>

                                <div>
                                    <label for="MeterAkhir" class="block text-gray-700 font-medium mb-2">Meter Akhir</label>
                                    <input type="number" name="MeterAkhir" id="MeterAkhir" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="JumlahPakai" class="block text-gray-700 font-medium mb-2">Jumlah
                                        Pakai</label>
                                    <input type="number" name="JumlahPakai" id="JumlahPakai" readonly
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg shadow-sm">
                                </div>

                                <div>
                                    <label for="BiayaBebanPemakai" class="block text-gray-700 font-medium mb-2">Biaya
                                        Beban</label>
                                    <input type="number" step="0.01" name="BiayaBebanPemakai" id="BiayaBebanPemakai"
                                        value="{{ old('NoKontrol') ? $biayaBeban : '' }}" readonly
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="BiayaPemakaian" class="block text-gray-700 font-medium mb-2">Biaya
                                        Pemakaian</label>
                                    <input type="number" step="0.01" name="BiayaPemakaian" id="BiayaPemakaian" readonly
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div class="flex justify-between mt-8">
                                <a href="{{ route('pemakaian.index') }}"
                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-300 ease-in-out transform hover:scale-105">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 focus:outline-none transition duration-300 ease-in-out transform hover:scale-105">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Script untuk Menghitung Jumlah Pakai -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const meterAwal = document.getElementById('MeterAwal');
                const meterAkhir = document.getElementById('MeterAkhir');
                const jumlahPakai = document.getElementById('JumlahPakai');
                const noKontrolSelect = document.getElementById('NoKontrol');
                const biayaBebanInput = document.getElementById('BiayaBebanPemakai');
                const biayaPemakaianInput = document.getElementById('BiayaPemakaian');
                const tahunSelect = document.querySelector('select[name="Tahun"]');
                const bulanSelect = document.querySelector('select[name="Bulan"]');
                noKontrolSelect.addEventListener('change', updateBulanTerpakai);
tahunSelect.addEventListener('change', updateBulanTerpakai);


function updateBulanTerpakai() {
    const noKontrol = noKontrolSelect.value;
    const tahun = tahunSelect.value;

    if (noKontrol && tahun) {
        fetch(`/get-bulan-terpakai?NoKontrol=${noKontrol}&Tahun=${tahun}`)
            .then(response => response.json())
            .then(data => {
                const bulanTerpakai = data.map(Number);
                Array.from(bulanSelect.options).forEach(option => {
                    const bulanVal = parseInt(option.value);
                    if (bulanTerpakai.includes(bulanVal)) {
                        option.disabled = true;
                        option.textContent = `${option.textContent.replace(' (sudah terisi)', '')} (sudah terisi)`;
                    } else {
                        option.disabled = false;
                        option.textContent = option.textContent.replace(' (sudah terisi)', '');
                    }
                });
            })
            .catch(error => console.error('Gagal mengambil data bulan terpakai:', error));
    }
}


                function ambilMeterAwal() {
                    const noKontrol = noKontrolSelect.value;
                    const tahun = tahunSelect.value;
                    const bulan = bulanSelect.value;

                    if (noKontrol && tahun && bulan) {
                        fetch(`/get-meter-awal?NoKontrol=${noKontrol}&Tahun=${tahun}&Bulan=${bulan}`)
                            .then(response => response.json())
                            .then(data => {
                                meterAwal.value = data.meter_akhir;
                                hitungJumlahPakai();
                            })
                            .catch(error => {
                                console.error('Gagal mengambil meter akhir bulan sebelumnya:', error);
                                meterAwal.value = 0;
                                hitungJumlahPakai();
                            });
                    }
                }

                // Trigger saat salah satu berubah
                noKontrolSelect.addEventListener('change', ambilMeterAwal);
                tahunSelect.addEventListener('change', ambilMeterAwal);
                bulanSelect.addEventListener('change', ambilMeterAwal);


                function hitungJumlahPakai() {
                    const awal = parseFloat(meterAwal.value) || 0;
                    const akhir = parseFloat(meterAkhir.value) || 0;
                    const hasil = akhir - awal;
                    const pakai = hasil > 0 ? hasil : 0;
                    jumlahPakai.value = pakai;
                    hitungBiayaPemakaian(); // Hitung ulang biaya pemakaian
                }

                function hitungBiayaPemakaian() {
                    const pakai = parseFloat(jumlahPakai.value) || 0;
                    const biayaBeban = parseFloat(biayaBebanInput.value) || 0;
                    biayaPemakaianInput.value = (pakai * biayaBeban).toFixed(2);
                }

                meterAwal.addEventListener('input', hitungJumlahPakai);
                meterAkhir.addEventListener('input', hitungJumlahPakai);
                biayaBebanInput.addEventListener('input', hitungBiayaPemakaian);

                noKontrolSelect.addEventListener('change', function() {
                    const noKontrol = this.value;

                    if (noKontrol) {
                        fetch(`/get-tarif/${noKontrol}`)
                            .then(response => response.json())
                            .then(data => {
                                biayaBebanInput.value = data.biaya_beban;
                                hitungBiayaPemakaian(); // update setelah tarif diambil
                            })
                            .catch(error => {
                                console.error('Error fetching tarif:', error);
                                biayaBebanInput.value = 0;
                                hitungBiayaPemakaian();
                            });
                    } else {
                        biayaBebanInput.value = 0;
                        hitungBiayaPemakaian();
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
