<x-app-layout>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 p-4">
                    <h3 class="text-xl font-semibold">Tambah Pelanggan</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('pelanggan.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label for="NoKontrol" class="block text-gray-700 font-semibold mb-2">No Kontrol</label>
                            <input type="number" id="NoKontrol" name="NoKontrol"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('NoKontrol') border-red-500 @enderror"
                                   required>
                            @error('NoKontrol')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="Nama" class="block text-gray-700 font-semibold mb-2">Nama</label>
                            <input type="text" id="Nama" name="Nama"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Nama') border-red-500 @enderror"
                                   required>
                            @error('Nama')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="Alamat" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                            <textarea id="Alamat" name="Alamat"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Alamat') border-red-500 @enderror"
                                      required></textarea>
                            @error('Alamat')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="Telepon" class="block text-gray-700 font-semibold mb-2">Telepon</label>
                            <input type="number" id="Telepon" name="Telepon"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Telepon') border-red-500 @enderror"
                                   pattern="[0-9]+" title="Hanya angka yang diperbolehkan" required>
                            @error('Telepon')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="Jenis_Plg" class="block text-gray-700 font-semibold mb-2">Jenis Pelanggan</label>
                            <select id="Jenis_Plg" name="Jenis_Plg"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Jenis_Plg') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Jenis Pelanggan</option>
                                @foreach ($tarifs as $tarif)
                                    <option value="{{ $tarif->Jenis_Plg }}">{{ $tarif->Jenis_Plg }}</option>
                                @endforeach
                            </select>
                            @error('Jenis_Plg')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-between mt-5">
                            <a href="{{ route('pelanggan.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Kembali</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 focus:outline-none">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
