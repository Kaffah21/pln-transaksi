<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemakaian Listrik</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .filter-info {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #888;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

    </style>
</head>
<body>
    <h2>Laporan Pemakaian Listrik</h2>
    <div class="filter-info">
        <div>
            @if(request('tahun'))
                <strong>Tahun:</strong> {{ request('tahun') }}
            @endif
            @if(request('bulan'))
                | <strong>Bulan:</strong> {{ \Carbon\Carbon::createFromFormat('m', request('bulan'))->translatedFormat('F') }}
            @endif
            @if(request('no_kontrol'))
                | <strong>No Kontrol:</strong> {{ request('no_kontrol') }}
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>No Kontrol</th>
                <th>Jumlah Pakai (kWh)</th>
                <th>Biaya Beban (Rp)</th>
                <th>Biaya Pemakaian (Rp)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemakaians as $pemakaian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pemakaian->Tahun }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('m', $pemakaian->Bulan)->translatedFormat('F') }}</td>
                    <td class="text-left">{{ $pemakaian->NoKontrol }}</td>
                    <td>{{ $pemakaian->JumlahPakai }}</td>
                    <td class="text-right">Rp {{ number_format($pemakaian->BiayaBebanPemakai, 2, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($pemakaian->BiayaPemakaian, 2, ',', '.') }}</td>
                    <td>{{ $pemakaian->Status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Tidak ada data tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
