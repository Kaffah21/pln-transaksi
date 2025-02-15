<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="bg-gray-100 p-4 flex justify-between items-center">
                    <h1 class="text-3xl font-bold">Pelanggan</h1>
                    <a href="{{ route('pelanggan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                        <i class="fas fa-plus fs-2 mr-2"></i> TambahPelanggan
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kontrol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telpon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($pelanggans as $index => $pelanggan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->NoKontrol }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700"> {{$pelanggan->Nama}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->Alamat}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->Telpon}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pelanggan->Jenis_Plg}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 flex items-center" title="Edit">
                                            <i class="fas fa-pencil-alt fs-2"></i>
                                        </a>
                                        <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" class="inline">
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
                        {{ $pelanggans->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
