<x-app-layout>
    @section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6">
                <h3 class="text-xl font-bold mb-2">Bukti Pembayaran</h3>
                <p>No Kontrol: {{ $no_kontrol }}</p>
                <p>Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
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
                <p><strong>Dibayar:</strong> Rp {{ number_format($jumlahBayar, 0, ',', '.') }}</p>
                <p><strong>Kembalian:</strong> Rp {{ number_format($kembalian, 0, ',', '.') }}</p>

                <div class="mt-6">
                    <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                        Cetak Struk
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
