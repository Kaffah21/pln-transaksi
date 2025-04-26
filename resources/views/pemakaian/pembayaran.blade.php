<x-app-layout>
<style>
    @media print {
        /* Sembunyikan semua elemen selain struk */
        body * {
            visibility: hidden;
        }
        
        #struk, #struk * {
            visibility: visible;
        }

        /* Sesuaikan ukuran untuk struk */
        #struk {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
            font-size: 12px;
        }
    }
</style>

    @section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">
                <h2 class="text-2xl font-bold mb-4">Pembayaran - No Kontrol: {{ $no_kontrol }}</h2>

                @if ($tagihan->isEmpty())
                    <p class="text-gray-500">Tidak ada tagihan untuk dibayar.</p>
                @else
                    @php
                        $totalTagihan = $tagihan->sum(function($t) {
                            return $t->BiayaPemakaian + $t->BiayaBebanPemakai;
                        });
                    @endphp

                    <form action="{{ route('pembayaran.bayar') }}" method="POST" id="form-bayar">
                        @csrf
                        <input type="hidden" name="no_kontrol" value="{{ $no_kontrol }}">

                        <table class="table-auto w-full mb-6">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Tahun</th>
                                    <th class="px-4 py-2">Bulan</th>
                                    <th class="px-4 py-2">Jumlah Pakai</th>
                                    <th class="px-4 py-2">Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan as $t)
                                    <tr>
                                        <td class="px-4 py-2">{{ $t->Tahun }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('m', $t->Bulan)->translatedFormat('F') }}</td>
                                        <td class="px-4 py-2">{{ $t->JumlahPakai }} kWh</td>
                                        <td class="px-4 py-2">Rp {{ number_format($t->BiayaPemakaian + $t->BiayaBebanPemakai, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mb-4">
                            <label class="block font-medium mb-1">Total Tagihan</label>
                            <input type="text" readonly value="Rp {{ number_format($totalTagihan, 0, ',', '.') }}"
                                class="w-full bg-gray-100 border border-gray-300 rounded px-4 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1">Jumlah Dibayar</label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar"
                                class="w-full border border-gray-300 rounded px-4 py-2" required>
                        </div>

                        <div class="mb-6">
                            <label class="block font-medium mb-1">Kembalian</label>
                            <input type="text" id="kembalian" readonly
                                class="w-full bg-gray-100 border border-gray-300 rounded px-4 py-2">
                        </div>

                        <button type="button" id="btn-bayar"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                            Bayar
                        </button>
                    </form>

                    {{-- Struk (hanya muncul saat print) --}}
                    <div id="struk" class="hidden print:block bg-white p-4 mt-8 border border-gray-300 rounded text-sm">
                        <h3 class="text-xl font-bold mb-2">Bukti Pembayaran</h3>
                        <p>No Kontrol: {{ $no_kontrol }}</p>
                        <p>Tanggal: <span id="tanggal-struk"></span></p>
                        <hr class="my-2">
                        <table class="w-full text-left mb-2">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Bulan</th>
                                    <th>Jumlah Pakai</th>
                                    <th>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan as $t)
                                    <tr>
                                        <td>{{ $t->Tahun }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('m', $t->Bulan)->translatedFormat('F') }}</td>
                                        <td>{{ $t->JumlahPakai }} kWh</td>
                                        <td>Rp {{ number_format($t->BiayaPemakaian + $t->BiayaBebanPemakai, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p><strong>Total Tagihan:</strong> Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
                        <p><strong>Dibayar:</strong> <span id="dibayar-struk"></span></p>
                        <p><strong>Kembalian:</strong> <span id="kembalian-struk"></span></p>
                    </div>

                    {{-- Script --}}
                    <script>
                        const jumlahBayar = document.getElementById('jumlah_bayar');
                        const kembalian = document.getElementById('kembalian');
                        const total = {{ $totalTagihan }};
                        const btnBayar = document.getElementById('btn-bayar');

                        jumlahBayar.addEventListener('input', function () {
                            const bayar = parseInt(this.value || 0);
                            const kembali = bayar - total;
                            kembalian.value = kembali >= 0 ? 'Rp ' + kembali.toLocaleString('id-ID') : '-';
                        });

                        btnBayar.addEventListener('click', function (e) {
    e.preventDefault(); // cegah form langsung submit

    const bayar = parseInt(jumlahBayar.value || 0);
    const kembali = bayar - total;

    if (isNaN(bayar) || bayar < total) {
        alert("Jumlah bayar kurang dari total tagihan.");
        return;
    }

    // Isi data ke struk
    document.getElementById('tanggal-struk').textContent = new Date().toLocaleDateString('id-ID');
    document.getElementById('dibayar-struk').textContent = 'Rp ' + bayar.toLocaleString('id-ID');
    document.getElementById('kembalian-struk').textContent = 'Rp ' + kembali.toLocaleString('id-ID');

    // Tampilkan struk & cetak
    document.getElementById('struk').classList.remove('hidden');
    window.print();

    // Submit form setelah cetak
    document.getElementById('form-bayar').submit();
});

                    </script>
                @endif
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
