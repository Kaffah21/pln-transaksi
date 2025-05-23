<x-app-layout>

    @section('content')
        <div class="py-8">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex h-screen">

                            <!-- Main Content -->
                            <div class="flex-1 p-10">
                                <!-- Stats Cards -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                                    <div class="p-6 bg-white shadow-lg rounded-xl text-center hover:bg-blue-50 ">
                                        <div class="flex items-center justify-center mb-4">
                                            <i class="fas fa-users text-3xl text-blue-600"></i>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-700">Pelanggan</h2>
                                        <p class="text-2xl font-bold text-blue-600">{{ $totalPelanggans }}</p>
                                    </div>

                                    <div class="p-6 bg-white shadow-lg rounded-xl text-center hover:bg-yellow-40 ">
                                        <div class="flex items-center justify-center mb-4">
                                            <i class="fas fa-plug text-3xl text-yellow-400"></i>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-700">Total Pemakaian</h2>
                                        <p class="text-2xl font-bold text-yellow-400">{{ number_format($totalPemakaian, 0, ',', '.') }} KWh</p>
                                    </div>

                                    <div class="p-6 bg-white shadow-lg rounded-xl text-center hover:bg-green-50 ">
                                        <div class="flex items-center justify-center mb-4">
                                            <i class="fas fa-money-bill-wave text-3xl text-green-600"></i>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-700">Lunas</h2>
                                        <p class="text-2xl font-bold text-green-600">{{ $lunas }}</p>
                                    </div>

                                    <div class="p-6 bg-white shadow-lg rounded-xl text-center hover:bg-red-50 ">
                                        <div class="flex items-center justify-center mb-4">
                                            <i class="fas fa-exclamation-triangle text-3xl text-red-600"></i>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-700">Belum Dibayar</h2>
                                        <p class="text-2xl font-bold text-red-600">{{ $belumBayar }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <script>
        const ctx = document.getElementById('usageChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pemakaian (KWh)',
                    data: [2000, 2500, 3000, 2800, 3200, 3500],
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                }]
            }
        });
    </script>
    </x-app-layout>
