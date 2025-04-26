<div x-data="{ open: false }" class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div :class="{'block': open, 'hidden': !open}" class="fixed inset-0 z-10 bg-gray-800 bg-opacity-50 sm:hidden" @click="open = false"></div>
      <div :class="{'translate-x-0': open, '-translate-x-full': !open}" class="transition-transform transform fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-20 sm:relative sm:translate-x-0">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <img src="{{ asset('asset/logo.jpg') }}" alt="PLN Logo" class="h-16">
            </a>
            <button @click="open = false" class="text-gray-600 hover:text-red-500 transition duration-300 sm:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="space-y-2 px-4 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-300">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M3 15h18M3 21h18"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.petugas.index') }}" class="flex items-center space-x-3 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-300">
                    <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-8 0v2h3M9 20H4v-2a4 4 0 018 0v2H9zM12 11a4 4 0 100-8 4 4 0 000 8zM20 8a4 4 0 11-8 0"></path>
                    </svg>
                    <span>Petugas</span>
                </a>

                <a href="{{ route('tarif.index') }}" class="flex items-center space-x-3 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-300">
                    <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span>Jenis tarif</span>
                </a>
            @endif

            <a href="{{ route('pelanggan.index') }}" class="flex items-center space-x-3 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-300">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
                </svg>
                <span>Pelanggan</span>
            </a>

            <a href="{{ route('pemakaian.index')}}" class="flex items-center space-x-3 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-300">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M5 8h14"></path>
                </svg>
                <span>Pemakaian</span>
            </a>

            <a href="{{ route('laporan.list')}}" class="flex items-center space-x-3 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-300">
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M5 8h14"></path>
                </svg>
                <span>Laporan</span>
            </a>
        </div>


    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 sm:hidden">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden sm:flex sm:items-center ml-auto">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-500 text-white text-sm font-semibold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 text-sm text-gray-500">
                                    <strong>Role:</strong> {{ Auth::user()->role }}
                                </div>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                      this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content goes here -->
        <div class="flex-1 p-6 ml-0 md:ml-24 transition-all duration-300 overflow-y-auto" id="main-content">
            @yield('content')
        </div>
    </div>
</div>
