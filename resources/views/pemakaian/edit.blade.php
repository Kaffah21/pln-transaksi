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
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                <strong class="font-bold">Ups!</strong>
                                <span class="block text-sm">Ada kesalahan saat input data:</span>
                            </div>
                        @endif

                        <form action="{{ route('pemakaian.update', $pemakaian->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="NoKontrol" class="block text-gray-700 font-medium mb-2">Pelanggan</label>
                                    <select name="NoKontrol" id="NoKontrol" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach($pelanggans as $pelanggan)
                                            <option value="{{ $pelanggan->NoKontrol }}"
                                                {{ $pemakaian->NoKontrol == $pelanggan->NoKontrol ? 'selected' : '' }}>
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
                                            <option value="{{ $year }}" {{ $pemakaian->Tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
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

                                <div>
                                    <label for="MeterAwal" class="block text-gray-700 font-medium mb-2">Meter Awal</label>
                                    <input type="number" name="MeterAwal" id="MeterAwal" required value="{{ $pemakaian->MeterAwal }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="MeterAkhir" class="block text-gray-700 font-medium mb-2">Meter Akhir</label>
                                    <input type="number" name="MeterAkhir" id="MeterAkhir" required value="{{ $pemakaian->MeterAkhir }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="JumlahPakai" class="block text-gray-700 font-medium mb-2">Jumlah Pakai</label>
                                    <input type="number" name="JumlahPakai" id="JumlahPakai" readonly value="{{ $pemakaian->JumlahPakai }}"
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg shadow-sm">
                                </div>

                                <div>
                                    <label for="BiayaBebanPemakai" class="block text-gray-700 font-medium mb-2">Biaya Beban</label>
                                    <input type="number" step="0.01" name="BiayaBebanPemakai" id="BiayaBebanPemakai" readonly value="{{ $pemakaian->BiayaBebanPemakai }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label for="BiayaPemakaian" class="block text-gray-700 font-medium mb-2">Biaya Pemakaian</label>
                                    <input type="number" step="0.01" name="BiayaPemakaian" id="BiayaPemakaian" readonly value="{{ $pemakaian->BiayaPemakaian }}"
                                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg shadow-sm" readonly>
                                </div>
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
                const biayaBeban = document.getElementById('BiayaBebanPemakai');
                const biayaPemakaian = document.getElementById('BiayaPemakaian');
                const noKontrolSelect = document.getElementById('NoKontrol');
                const tahunSelect = document.querySelector('select[name="Tahun"]');
const bulanSelect = document.querySelector('select[name="Bulan"]');
const bulanSaatIni = {{ $pemakaian->Bulan }}; // agar tetap bisa edit bulan ini

function updateBulanTerpakaiEdit() {
    const noKontrol = noKontrolSelect.value;
    const tahun = tahunSelect.value;

    if (noKontrol && tahun) {
        fetch(`/get-bulan-terpakai?NoKontrol=${noKontrol}&Tahun=${tahun}`)
            .then(response => response.json())
            .then(data => {
                const bulanTerpakai = data.map(Number);
                Array.from(bulanSelect.options).forEach(option => {
                    const bulanVal = parseInt(option.value);
                    if (
                        bulanTerpakai.includes(bulanVal) &&
                        bulanVal !== bulanSaatIni
                    ) {
                        option.disabled = true;
                        if (!option.textContent.includes('(sudah terisi)')) {
                            option.textContent += ' (sudah terisi)';
                        }
                    } else {
                        option.disabled = false;
                        option.textContent = option.textContent.replace(' (sudah terisi)', '');
                    }
                });
            })
            .catch(error => console.error('Gagal ambil bulan terpakai (edit):', error));
    }
}

noKontrolSelect.addEventListener('change', updateBulanTerpakaiEdit);
tahunSelect.addEventListener('change', updateBulanTerpakaiEdit);

updateBulanTerpakaiEdit(); // panggil sekali saat load

        
        
                function hitungJumlahPakai() {
                    const awal = parseFloat(meterAwal.value) || 0;
                    const akhir = parseFloat(meterAkhir.value) || 0;
                    const pakai = akhir - awal;
                    jumlahPakai.value = pakai > 0 ? pakai : 0;
                    hitungBiayaPemakaian(); // hitung otomatis biaya
                }
        
                function hitungBiayaPemakaian() {
                    const pakai = parseFloat(jumlahPakai.value) || 0;
                    const beban = parseFloat(biayaBeban.value) || 0;
                    biayaPemakaian.value = (pakai * beban).toFixed(2);
                }
        
                meterAwal.addEventListener('input', hitungJumlahPakai);
                meterAkhir.addEventListener('input', hitungJumlahPakai);
                biayaBeban.addEventListener('input', hitungBiayaPemakaian);
        
                noKontrolSelect.addEventListener('change', function () {
                    this.form.submit(); // jika kamu ingin reload untuk isi data tarif dari DB
                });
        
                hitungJumlahPakai();
            });
        </script>
        
    @endsection
</x-app-layout>