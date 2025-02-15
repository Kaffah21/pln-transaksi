<x-app-layout>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 p-4">
                    <h3 class="text-xl font-semibold">Edit Pelanggan</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('pelanggan.update', $pelanggan->NoKontrol) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="NoKontrol" class="block text-gray-700 font-semibold mb-2">No Kontrol</label>
                            <input type="number" name="NoKontrol" id="NoKontrol" value="{{ old('NoKontrol', $pelanggan->NoKontrol) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md @error('NoKontrol') border-red-500 @enderror" required>
                            @error('NoKontrol')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="Nama" class="block text-gray-700 font-semibold mb-2">Nama</label>
                            <input type="text" name="Nama" id="Nama" value="{{ old('Nama', $pelanggan->Nama) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Nama') border-red-500 @enderror" required>
                            @error('Nama')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="Alamat" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                            <textarea name="Alamat" id="Alamat"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Alamat') border-red-500 @enderror" required>{{ old('Alamat', $pelanggan->Alamat) }}</textarea>
                            @error('Alamat')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="Telepon" class="block text-gray-700 font-semibold mb-2">Telepon</label>
                            <input type="number" name="Telepon" id="Telepon" value="{{ old('Telepon', $pelanggan->Telepon) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Telepon') border-red-500 @enderror" required>
                            @error('Telepon')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="Jenis_Plg" class="block text-gray-700 font-semibold mb-2">Jenis Pelanggan</label>
                            <select name="Jenis_Plg" id="Jenis_Plg"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Jenis_Plg') border-red-500 @enderror" required>
                                <option value="">Pilih Jenis Pelanggan</option>
                                @foreach ($tarifs as $tarif)
                                    <option value="{{ $tarif->Jenis_Plg }}" {{ $tarif->Jenis_Plg == old('Jenis_Plg', $pelanggan->Jenis_Plg) ? 'selected' : '' }}>
                                        {{ $tarif->Jenis_Plg }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Jenis_Plg')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-between mt-5">
                            <a href="{{ route('pelanggan.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Batal</a>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:ring-2 focus:ring-green-300 focus:outline-none">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
