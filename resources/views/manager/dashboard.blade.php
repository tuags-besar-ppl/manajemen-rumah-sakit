<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Manager Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-custom': 'rgb(0, 115, 209)',
                        'blue-light': 'rgb(78, 175, 254)'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans min-h-screen">
    <!-- Header Component -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Navigation Component -->
                <nav class="hidden md:flex space-x-8">
                    <!-- Active Nav Item -->
                    <a href="#" class="text-blue-custom font-semibold border-b-2 border-blue-custom pb-4 px-1 text-sm transition-colors hover:text-blue-light">
                        Dashboard
                    </a>
                    <!-- Regular Nav Items -->
                    <a href="#" class="text-gray-500 hover:text-blue-custom font-medium pb-4 px-1 text-sm transition-colors">
                        List Peralatan
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-custom font-medium pb-4 px-1 text-sm transition-colors">
                        Rekapitulasi Peralatan
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-custom font-medium pb-4 px-1 text-sm transition-colors">
                        Laporan Alat Rusak
                    </a>
                    <a href="#" class="text-gray-500 hover:text-blue-custom font-medium pb-4 px-1 text-sm transition-colors">
                        Kategori Alat
                    </a>
                </nav>
                
                <!-- User Actions Component -->
                <div class="flex items-center space-x-4">
                    <!-- Icon Button Component - Search -->
                    <button class="p-2 text-gray-400 hover:text-blue-custom hover:bg-gray-100 rounded-lg transition-colors" onclick="handleSearch()">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <!-- Icon Button Component - Messages -->
                    <button class="p-2 text-gray-400 hover:text-blue-custom hover:bg-gray-100 rounded-lg transition-colors" onclick="handleMessages()">
                        <i class="fas fa-envelope text-lg"></i>
                    </button>
                    <!-- Icon Button Component - Notifications -->
                    <button class="p-2 text-gray-400 hover:text-blue-custom hover:bg-gray-100 rounded-lg transition-colors" onclick="handleNotifications()">
                        <i class="fas fa-bell text-lg"></i>
                    </button>
                    <!-- User Avatar Component -->
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-custom to-blue-light rounded-full flex items-center justify-center text-white font-semibold text-sm cursor-pointer" onclick="handleUserMenu()">
                        AR
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header Component -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Rekapitulasi</h1>
            <p class="text-gray-600">Monitor dan kelola peralatan dengan mudah</p>
        </div>
        
        <!-- Status Cards Container -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Status Card Component - Total Equipment -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow cursor-pointer" onclick="handleCardClick('total')">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">142</div>
                        <div class="text-gray-600 font-medium">Jumlah Alat</div>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-blue-custom to-blue-light rounded-xl flex items-center justify-center">
                        <i class="fas fa-tools text-white text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 font-medium">+12%</span>
                    <span class="text-gray-500 ml-2">dari bulan lalu</span>
                </div>
            </div>
            
            <!-- Status Card Component - In Use -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow cursor-pointer" onclick="handleCardClick('inuse')">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">36</div>
                        <div class="text-gray-600 font-medium">Sedang digunakan</div>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-sync-alt text-white text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-blue-600 font-medium">25%</span>
                    <span class="text-gray-500 ml-2">tingkat penggunaan</span>
                </div>
            </div>
            
            <!-- Status Card Component - Damaged -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow cursor-pointer" onclick="handleCardClick('damaged')">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">7</div>
                        <div class="text-gray-600 font-medium">Alat Rusak</div>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-white text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-red-600 font-medium">-2</span>
                    <span class="text-gray-500 ml-2">dari minggu lalu</span>
                </div>
            </div>
        </div>
        
        <!-- Filter Section Component -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <!-- Filter Header -->
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-blue-custom mr-3"></i>
                    Filters
                </h3>
            </div>
            
            <!-- Filter Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Equipment Status Filter Component -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Equipment Status</h4>
                        <div class="space-y-3">
                            <!-- Checkbox Component - Tersedia -->
                            <label class="flex items-center group cursor-pointer" onclick="toggleCheckbox('tersedia', this)">
                                <div id="checkbox-tersedia" class="w-5 h-5 bg-blue-custom border-2 border-blue-custom rounded flex items-center justify-center mr-3 group-hover:bg-blue-light transition-colors">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Tersedia</span>
                            </label>
                            
                            <!-- Checkbox Component - Sedang Digunakan -->
                            <label class="flex items-center group cursor-pointer" onclick="toggleCheckbox('digunakan', this)">
                                <div id="checkbox-digunakan" class="w-5 h-5 bg-blue-custom border-2 border-blue-custom rounded flex items-center justify-center mr-3 group-hover:bg-blue-light transition-colors">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Sedang Digunakan</span>
                            </label>
                            
                            <!-- Checkbox Component - Siap digunakan -->
                            <label class="flex items-center group cursor-pointer" onclick="toggleCheckbox('siap', this)">
                                <div id="checkbox-siap" class="w-5 h-5 bg-blue-custom border-2 border-blue-custom rounded flex items-center justify-center mr-3 group-hover:bg-blue-light transition-colors">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Siap digunakan</span>
                            </label>
                            
                            <!-- Checkbox Component - Rusak -->
                            <label class="flex items-center group cursor-pointer" onclick="toggleCheckbox('rusak', this)">
                                <div id="checkbox-rusak" class="w-5 h-5 bg-white border-2 border-gray-300 rounded flex items-center justify-center mr-3 group-hover:border-blue-custom transition-colors">
                                </div>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Rusak</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Filter By Time Component -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Filter By</h4>
                        <div class="space-y-3">
                            <!-- Radio Button Component - Recent Usage (Active) -->
                            <label class="flex items-center group cursor-pointer p-3 rounded-lg bg-gradient-to-r from-blue-custom to-blue-light text-white" onclick="selectRadio('recent', this)">
                                <div class="w-4 h-4 bg-white rounded-full mr-3 flex items-center justify-center">
                                    <div class="w-2 h-2 bg-blue-custom rounded-full"></div>
                                </div>
                                <i class="fas fa-clock mr-3"></i>
                                <span class="font-medium">Recent Usage</span>
                            </label>
                            
                            <!-- Radio Button Component - Last Hour -->
                            <label class="flex items-center group cursor-pointer p-3 rounded-lg hover:bg-gray-50 transition-colors" onclick="selectRadio('hour', this)">
                                <div class="w-4 h-4 bg-white border-2 border-gray-300 rounded-full mr-3 group-hover:border-blue-custom transition-colors">
                                </div>
                                <i class="fas fa-hourglass-half mr-3 text-gray-500 group-hover:text-blue-custom transition-colors"></i>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Last Hour</span>
                            </label>
                            
                            <!-- Radio Button Component - Today -->
                            <label class="flex items-center group cursor-pointer p-3 rounded-lg hover:bg-gray-50 transition-colors" onclick="selectRadio('today', this)">
                                <div class="w-4 h-4 bg-white border-2 border-gray-300 rounded-full mr-3 group-hover:border-blue-custom transition-colors">
                                </div>
                                <i class="fas fa-calendar-day mr-3 text-gray-500 group-hover:text-blue-custom transition-colors"></i>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Today</span>
                            </label>
                            
                            <!-- Radio Button Component - Custom Date -->
                            <label class="flex items-center group cursor-pointer p-3 rounded-lg hover:bg-gray-50 transition-colors" onclick="selectRadio('custom', this)">
                                <div class="w-4 h-4 bg-white border-2 border-gray-300 rounded-full mr-3 group-hover:border-blue-custom transition-colors">
                                </div>
                                <i class="fas fa-calendar-alt mr-3 text-gray-500 group-hover:text-blue-custom transition-colors"></i>
                                <span class="text-gray-700 font-medium group-hover:text-blue-custom transition-colors">Custom Date</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons Component -->
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <!-- Primary Button Component -->
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-custom to-blue-light text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-400 transition-all transform hover:scale-105 shadow-lg" onclick="applyFilters()">
                        <i class="fas fa-search mr-2"></i>
                        Apply Filters
                    </button>
                    <!-- Secondary Button Component -->
                    <button class="px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 hover:text-blue-custom transition-colors" onclick="resetFilters()">
                        <i class="fas fa-redo mr-2"></i>
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Global state for filters
        let filterState = {
            checkboxes: {
                'tersedia': true,
                'digunakan': true,
                'siap': true,
                'rusak': false
            },
            selectedRadio: 'recent'
        };

        // Icon Button Handlers
        function handleSearch() {
            console.log('Search clicked');
            // Add search functionality here
        }

        function handleMessages() {
            console.log('Messages clicked');
            // Add messages functionality here
        }

        function handleNotifications() {
            console.log('Notifications clicked');
            // Add notifications functionality here
        }

        function handleUserMenu() {
            console.log('User menu clicked');
            // Add user menu functionality here
        }

        // Status Card Handlers
        function handleCardClick(cardType) {
            console.log(`${cardType} card clicked`);
            // Add navigation or modal functionality here
        }

        // Checkbox Component Handler
        function toggleCheckbox(checkboxId, element) {
            const checkbox = element.querySelector(`#checkbox-${checkboxId}`);
            const isChecked = filterState.checkboxes[checkboxId];
            
            // Toggle state
            filterState.checkboxes[checkboxId] = !isChecked;
            
            if (!isChecked) {
                // Check the checkbox
                checkbox.classList.add('bg-blue-custom', 'border-blue-custom');
                checkbox.classList.remove('bg-white', 'border-gray-300');
                checkbox.innerHTML = '<i class="fas fa-check text-white text-xs"></i>';
            } else {
                // Uncheck the checkbox
                checkbox.classList.remove('bg-blue-custom', 'border-blue-custom');
                checkbox.classList.add('bg-white', 'border-gray-300');
                checkbox.innerHTML = '';
            }
            
            console.log(`Checkbox ${checkboxId} toggled:`, filterState.checkboxes[checkboxId]);
        }

        // Radio Button Component Handler
        function selectRadio(radioValue, element) {
            // Reset all radio buttons
            const allRadioLabels = document.querySelectorAll('label[onclick*="selectRadio"]');
            allRadioLabels.forEach(label => {
                label.classList.remove('bg-gradient-to-r', 'from-blue-custom', 'to-blue-light', 'text-white');
                label.classList.add('hover:bg-gray-50');
                
                const radioDiv = label.querySelector('div[class*="w-4 h-4"]');
                const icon = label.querySelector('i');
                const span = label.querySelector('span');
                
                if (radioDiv) {
                    radioDiv.classList.remove('bg-white');
                    radioDiv.classList.add('bg-white', 'border-2', 'border-gray-300');
                    radioDiv.innerHTML = '';
                }
                
                if (icon) {
                    icon.classList.remove('text-white');
                    icon.classList.add('text-gray-500', 'group-hover:text-blue-custom');
                }
                
                if (span) {
                    span.classList.remove('text-white');
                    span.classList.add('text-gray-700', 'group-hover:text-blue-custom');
                }
            });
            
            // Style the selected radio
            element.classList.add('bg-gradient-to-r', 'from-blue-custom', 'to-blue-light', 'text-white');
            element.classList.remove('hover:bg-gray-50');
            
            const selectedRadioDiv = element.querySelector('div[class*="w-4 h-4"]');
            const selectedIcon = element.querySelector('i');
            const selectedSpan = element.querySelector('span');
            
            if (selectedRadioDiv) {
                selectedRadioDiv.classList.add('bg-white');
                selectedRadioDiv.classList.remove('border-gray-300');
                selectedRadioDiv.innerHTML = '<div class="w-2 h-2 bg-blue-custom rounded-full"></div>';
            }
            
            if (selectedIcon) {
                selectedIcon.classList.add('text-white');
                selectedIcon.classList.remove('text-gray-500', 'group-hover:text-blue-custom');
            }
            
            if (selectedSpan) {
                selectedSpan.classList.add('text-white');
                selectedSpan.classList.remove('text-gray-700', 'group-hover:text-blue-custom');
            }
            
            filterState.selectedRadio = radioValue;
            console.log(`Radio ${radioValue} selected`);
        }

        // Action Button Handlers
        function applyFilters() {
            console.log('Applying filters with state:', filterState);
            // Add filter application logic here
            // This would typically send AJAX request to Laravel backend
        }

        function resetFilters() {
            console.log('Resetting filters');
            location.reload();
        }
    </script>
</body>
</html>