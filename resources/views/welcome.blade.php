@extends('layouts.user')

@section('content')
    <!-- Form Pencarian di Tengah -->
    <div class="flex justify-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/2">
            <h2 class="text-xl font-semibold text-gray-700 text-center">Cari Data</h2>
            <form method="GET" action="{{ route('pemakaian.cari') }}" class="mt-4">
                <div class="flex justify-center items-center space-x-4">
                    <!-- Input No Kontrol -->
                    <input type="text" id="nokontrol" name="nokontrol" placeholder="Masukkan No Kontrol"
                        class="px-4 py-2 border border-gray-300 rounded-l-md w-2/3" value="{{ request('nokontrol') }}">

                    <!-- Dropdown Bulan -->
                    <select name="bulan" id="bulan" class="px-4 py-2 border border-gray-300 rounded-md w-1/3">
                        <option value="">Pilih Bulan</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Dropdown Tahun -->
                    <select name="tahun" id="tahun" class="px-4 py-2 border border-gray-300 rounded-md w-1/3">
                        <option value="">Pilih Tahun</option>
                        @foreach(range(2020, date('Y')) as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>

                    <!-- Tombol Cari -->
                    <button type="submit" class="px-6 py-2  text-white rounded-md" style="background: #07acea">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hasil Pencarian -->
    @if(isset($pemakaians) && $pemakaians->count() > 0)
    <h3 class="text-xl font-semibold mt-8 text-gray-700 text-center">Hasil Pencarian</h3>
    <div class="flex justify-center mt-4"> <!-- This ensures that the grid is centered -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-5xl"> <!-- Limit width of the grid -->
            @foreach ($pemakaians as $pemakaian)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h4 class="font-semibold text-lg text-gray-700">{{ $pemakaian->NoKontrol }}</h4>
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
    {{-- <p class="mt-4 text-center text-gray-700">Tidak ada data </p> --}}
@endif

@endsection
