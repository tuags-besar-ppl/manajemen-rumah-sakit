<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - Sistem Management Alat Rumah Sakit</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <!-- Header Bar -->
<div class="fixed top-0 right-0 left-72 h-16 bg-white border-b border-gray-200 z-10 flex justify-between items-center px-8">
    <div class="text-xl font-semibold text-gray-800">
        Sistem Management Alat Rumah Sakit
    </div>
    <div class="flex items-center space-x-4">
        <form action="/logout" method="POST" class="mb-0">
            @csrf
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white border border-blue-600 rounded hover:bg-white hover:text-blue-600 transition">
            Logout
        </button>
        </form>
    </div>
</div>


    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-screen w-72 bg-gradient-to-b from-blue-600 to-blue-800 text-white">
        <div class="flex flex-col items-center pt-10">
            <!-- User Profile -->
            <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center mb-3 border-4 border-blue-500">
                <i class="fa-solid fa-user text-4xl text-blue-600"></i>
            </div>
            <div class="text-center mb-8">
                <h2 class="text-lg font-medium">{{ Auth::user()->name }}</h2>
                <p class="text-blue-200">{{ ucfirst(Auth::user()->role) }}</p>
            </div>

            <!-- Navigation Menu -->
            <nav class="w-full px-6">
                <a href="{{ route('dashboard-manager') }}" 
                   class="flex items-center space-x-4 px-4 py-3 rounded-lg mb-2 {{ Request::routeIs('dashboard-manager') ? 'bg-blue-500' : 'hover:bg-blue-700' }} transition-colors">
                    <i class="fa-solid fa-gauge-high text-xl"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <!-- Equipment Section with Dropdown -->
                <div class="mb-2">
                    <div class="flex items-center space-x-4 px-4 py-3 rounded-lg {{ Request::routeIs('equipment.*') ? 'bg-blue-500' : 'hover:bg-blue-700' }} transition-colors cursor-pointer" 
                         onclick="toggleEquipmentMenu()">
                        <i class="fa-solid fa-hospital text-xl"></i>
                        <span class="font-medium">Peralatan</span>
                        <i class="fa-solid fa-chevron-down ml-auto" id="equipmentArrow"></i>
                    </div>
                    
                    <div class="pl-4 mt-2 hidden" id="equipmentSubmenu">
                        <a href="{{ route('equipment.index') }}" 
                           class="flex items-center space-x-4 px-4 py-2 rounded-lg mb-1 {{ Request::is('equipment') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition-colors">
                            <i class="fa-solid fa-list text-sm"></i>
                            <span class="font-medium">Daftar Peralatan</span>
                        </a>
                        <a href="{{ route('equipment.create') }}" 
                           class="flex items-center space-x-4 px-4 py-2 rounded-lg {{ Request::is('equipment/create') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition-colors">
                            <i class="fa-solid fa-plus text-sm"></i>
                            <span class="font-medium">Tambah Peralatan</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('manager.reports.index') }}" 
                   class="flex items-center space-x-4 px-4 py-3 rounded-lg mb-2 {{ Request::routeIs('manager.reports.*') ? 'bg-blue-600' : 'hover:bg-blue-700' }} transition-colors">
                    <i class="fa-solid fa-clipboard-list text-xl"></i>
                    <span class="font-medium">Laporan Kerusakan</span>
                    @if($reportCount = \App\Models\DamageReport::where('status', 'diajukan')->count())
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $reportCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('manager.email') }}" 
                   class="flex items-center space-x-4 px-4 py-3 rounded-lg mb-2 {{ Request::routeIs('manager.email') ? 'bg-blue-500' : 'hover:bg-blue-700' }} transition-colors">
                    <i class="fa-solid fa-envelope text-xl"></i>
                    <span class="font-medium">Email</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-72 pt-20 p-8">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
        function toggleEquipmentMenu() {
            const submenu = document.getElementById('equipmentSubmenu');
            const arrow = document.getElementById('equipmentArrow');
            submenu.classList.toggle('hidden');
            arrow.classList.toggle('fa-chevron-down');
            arrow.classList.toggle('fa-chevron-up');
        }

        // Auto-expand menu if on equipment pages
        if (window.location.pathname.includes('/equipment')) {
            toggleEquipmentMenu();
        }
    </script>
</body>
</html> 