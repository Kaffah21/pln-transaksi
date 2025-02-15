<x-app-layout>

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex h-screen">


                        <!-- Main Content -->
                        <div class="flex-1 p-10">
                            <!-- Stats Cards -->
                            <div class="grid grid-cols-4 gap-4 mb-5">
                                <div class="p-5 bg-white shadow rounded-lg text-center">
                                    <h2 class="text-xl font-bold">Total Pelanggan</h2>
                                    <p class="text-2xl text-blue-600">250</p>
                                </div>
                                <div class="p-5 bg-white shadow rounded-lg text-center">
                                    <h2 class="text-xl font-bold">Total Pemakaian</h2>
                                    <p class="text-2xl text-blue-600">12,500 KWh</p>
                                </div>
                                <div class="p-5 bg-white shadow rounded-lg text-center">
                                    <h2 class="text-xl font-bold">Total Tagihan</h2>
                                    <p class="text-2xl text-blue-600">Rp 150,000,000</p>
                                </div>
                                <div class="p-5 bg-white shadow rounded-lg text-center">
                                    <h2 class="text-xl font-bold">Belum Dibayar</h2>
                                    <p class="text-2xl text-red-600">Rp 30,000,000</p>
                                </div>
                            </div>

                            <!-- Chart -->
                            <div class="bg-white p-5 shadow rounded-lg">
                                <h2 class="text-xl font-bold mb-3">Grafik Pemakaian Listrik</h2>
                                <canvas id="usageChart"></canvas>
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
