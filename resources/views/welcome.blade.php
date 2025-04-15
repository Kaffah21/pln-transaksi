@extends('layouts.user')

@section('content')
    <!-- Form Pencarian di Tengah -->
    <div class="flex justify-center py-8 bg-gradient-to-r from-teal-400 to-blue-500">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full md:w-1/2">
            <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Cari Data</h2>
            <form method="GET" action="{{ route('pemakaian.cari') }}" class="space-y-6">
                <div class="flex flex-col space-y-4">
                    <!-- Input No Kontrol -->
                    <input type="text" id="nokontrol" name="nokontrol" placeholder="Masukkan No Kontrol"
                        class="px-4 py-3 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-teal-400 transition duration-300" value="{{ request('nokontrol') }}">

                    <!-- Dropdown Bulan -->
                    <select name="bulan" id="bulan" class="px-4 py-3 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-teal-400 transition duration-300">
                        <option value="">Pilih Bulan</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Dropdown Tahun -->
                    <select name="tahun" id="tahun" class="px-4 py-3 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-teal-400 transition duration-300">
                        <option value="">Pilih Tahun</option>
                        @foreach(range(2020, date('Y')) as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>

                    <!-- Tombol Cari -->
                    <button type="submit" class="px-6 py-2  text-white rounded-md" style="background: #07acea">Cari</button>
                </div>
                            </div>
            </form>
        </div>
    </div>

    <!-- Hasil Pencarian -->
    @if(isset($pemakaians) && $pemakaians->count() > 0)
        <h3 class="text-2xl font-semibold mt-8 text-center text-gray-800">Hasil Pencarian</h3>
        <div class="flex justify-center mt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl">
                @foreach ($pemakaians as $pemakaian)
                    <div class="bg-white shadow-xl rounded-lg p-6 transform transition hover:scale-105 duration-300">
                        <h4 class="font-semibold text-lg text-gray-800">{{ $pemakaian->NoKontrol }}</h4>
                        <p class="text-gray-600 mt-2">Tahun: {{ $pemakaian->Tahun }}</p>
                        <p class="text-gray-600 mt-2">Bulan: {{ \Carbon\Carbon::createFromFormat('m', $pemakaian->Bulan)->translatedFormat('F') }}</p>
                        <p class="text-gray-600 mt-2">Jumlah Pakai: {{ $pemakaian->JumlahPakai }}</p>
                        <p class="text-gray-600 mt-2">Biaya Beban Pemakai: Rp {{ number_format($pemakaian->BiayaBebanPemakai, 2, ',', '.') }}</p>
                        <p class="text-gray-600 mt-2">Biaya Pemakaian: Rp {{ number_format($pemakaian->BiayaPemakaian, 2, ',', '.') }}</p>
                        <p class="text-gray-600 mt-2">
                            <span class="px-3 py-1 text-xs font-semibold {{ $pemakaian->Status == 'Lunas' ? 'text-green-700 bg-green-200' : 'text-red-700 bg-red-200' }} rounded-full">
                                {{ $pemakaian->Status }}
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="mt-4 text-center text-gray-700">Tidak ada data ditemukan.</p>
    @endif
@endsection
