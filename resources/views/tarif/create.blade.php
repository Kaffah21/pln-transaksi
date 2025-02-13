<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 p-4">
                    <h3 class="text-xl font-semibold">Tambah Tarif Pelanggan</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('tarif.store') }}">
                        @csrf

                        <!-- Jenis Pelanggan -->
                        <div class="mb-5">
                            <label for="Jenis_Plg" class="block text-gray-700 font-semibold mb-2">Jenis Pelanggan</label>
                            <input type="text" id="Jenis_Plg" name="Jenis_Plg"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('Jenis_Plg') border-red-500 @enderror"
                                   required>
                            @error('Jenis_Plg')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Biaya Beban -->
                        <div class="mb-5">
                            <label for="BiayaBeban" class="block text-gray-700 font-semibold mb-2">Biaya Beban (Rp)</label>
                            <input type="number" step="0.01" id="BiayaBeban" name="BiayaBeban" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('BiayaBeban') border-red-500 @enderror"
                                   required>
                            @error('BiayaBeban')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        

                        <!-- Tarif per KWH -->
                        <div class="mb-5">
                            <label for="TarifKWH" class="block text-gray-700 font-semibold mb-2">Tarif per KWH (Rp)</label>
                            <input type="number" step="0.01" id="TarifKWH" name="TarifKWH"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('TarifKWH') border-red-500 @enderror"
                                   required min="0">
                            @error('TarifKWH')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-between mt-5">
                            <a href="{{ route('tarif.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Kembali</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 focus:outline-none">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
