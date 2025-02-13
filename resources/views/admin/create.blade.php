<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 p-4">
                    <h3 class="text-xl font-semibold">Tambah Petugas Loket</h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.petugas.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-5">
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
                            <input type="text" id="name" name="name"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-5">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('email') border-red-500 @enderror"
                                   required>
                            @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-5">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                            <input type="password" id="password" name="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('password') border-red-500 @enderror"
                                   required>
                            @error('password')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-5">
                            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md @error('password_confirmation') border-red-500 @enderror"
                                   required>
                            @error('password_confirmation')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-between mt-5">
                            <a href="{{ route('admin.petugas.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Kembali</a>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 focus:outline-none">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
