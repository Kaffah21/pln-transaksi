<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="bg-gray-100 p-4 flex justify-between items-center">
                    <h1 class="text-3xl font-bold">Jenis Pelanggan</h1>
                    <a href="{{ route('tarif.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                        <i class="fas fa-plus fs-2 mr-2"></i> Tambah Jenis Pelanggan
                    </a>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">{{ session('success') }}</div>
                    @endif

                    <table class="table-auto w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya Beban (Rp)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif per KWh (Rp)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tarifs as $index => $tarif)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $tarif->Jenis_Plg }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($tarif->BiayaBeban, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($tarif->TarifKWH, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        <a href="{{ route('tarif.edit', $tarif) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 flex items-center" title="Edit">
                                            <i class="fas fa-pencil-alt fs-2"></i>
                                        </a>
                                        <form action="{{ route('tarif.destroy', $tarif) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 flex items-center" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash fs-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    {{-- <div>
                        {{ $tarifs->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
